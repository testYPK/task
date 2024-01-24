<?php

namespace App\Services;

use App\Models\Award;
use App\Models\File;
use App\Models\Log as OwnLog;
use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        $settings = Settings::first();

        $files = Storage::files('public/import');

        Award::truncate();

        foreach ($files as $file) {
            // Path to the file in storage
            $filePath = storage_path("app/$file");

            try {
                // Reading data from CSV File
                $awards = $this->parseCsvFile($filePath);

                Validator::make($awards, [
                    Award::$validationRules
                ]);

                array_map(fn($awardData) => Award::create($awardData), $awards);

                Storage::move($file, $settings->path
                    . '/'
                    . $settings->file_name_pattern
                    . '_'
                    . random_int(0,9999)
                );

                $this->logSuccess($filePath, count($awards));
            } catch (\Exception $e) {
                Log::error("Something wrong with data: " . $e->getMessage());
                $this->logError($filePath);
            }
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
        $settings = Settings::first();

        $savedFile = $uploadedFile->storeAs($settings->path, $settings->file_name_pattern);

        $file = File::create([
            'file_path' => $savedFile,
            'stored_name' => basename($savedFile),
            'processed_at' => Carbon::now(),
        ]);

        return $file;
    }
}
