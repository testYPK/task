<?php

namespace App\Services;

use App\Models\Award;
use App\Models\File;
use App\Models\Log as OwnLog;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\UnavailableStream;

class FileService
{
    /**
     * @throws UnavailableStream
     * @throws Exception
     */
    public function parseCsvFile(string $path): array
    {
        // Using the library league/csv to read the file
        $csv = Reader::createFromPath($path);
        $csv->setHeaderOffset(0);

        // Get all CSV strings as associative arrays
        $records = $csv->getRecords();
        $data = iterator_to_array($records);

        return array_map('array_change_key_case', $data);
    }

    /**
     * @throws UnavailableStream
     * @throws Exception
     */
    public function processCsvFiles(): void
    {
        Award::truncate();

        // Retrieving list of unprocessed files
        $unprocessedFiles = File::whereNull('processed_at')->get();

        foreach ($unprocessedFiles as $file) {
            // Path to the file in storage
            $filePath = storage_path("app/csvFiles/{$file->file_path}");

            try {
                // Reading data from CSV File
                $awards = $this->parseCsvFile($file->path());

                Validator::make($awards, [
                    Award::$validationRules
                ]);

                array_map(fn($awardData) => Award::create($awardData), $awards);

                $this->logSuccess($file->path(), count($awards));
            } catch (\Exception $e) {
                Log::error("Something wrong with data: " . $e->getMessage());
                $this->logError($file->path());
            }

            // Update processed_at and stored_name fields
            $file->update([
                'processed_at' => now(),
                'stored_name' => 'processed_' . $file->stored_name,
            ]);
        }
    }

    public function logSuccess(string $filePath, int $countAwards): void
    {
        OwnLog::create([
            'file_path' => $filePath,
            'status' => OwnLog::STATUS_SUCCESS,
            'records_added' => $countAwards,
        ]);
    }

    public function logError(string $filePath): void
    {
        OwnLog::create([
            'file_path' => storage_path($filePath),
            'status' => OwnLog::STATUS_FAIL,
        ]);
    }

    public function storeFile(UploadedFile $uploadedFile): File
    {
        $savedFile = $uploadedFile->storeAs('csvFiles', 'testName' . time());

        $file = File::create([
            'file_path' => $savedFile,
            'stored_name' => basename($savedFile),
            'processed_at' => Carbon::now(),
        ]);

        return $file;
    }
}
