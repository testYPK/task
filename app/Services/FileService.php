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
