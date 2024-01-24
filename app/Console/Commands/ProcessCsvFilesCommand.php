<?php

namespace App\Console\Commands;

use App\Models\Award;
use App\Models\Settings;
use App\Services\FileService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProcessCsvFilesCommand extends Command
{
    public function __construct(private readonly FileService $fileService)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:process';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process CSV files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $patternPath = Settings::where('key', 'path')->first();
        $patternFileName = Settings::where('key', 'file_name_pattern')->first();

        $files = glob(storage_path('app/public/import') . '/*.csv');

        Award::truncate();

        foreach ($files as $filePath) {
            // Path to the file in storage

            try {
                // Reading data from CSV File
                $awards = $this->fileService->parseCsvFile($filePath);

                Validator::make($awards, [
                    Award::$validationRules
                ]);

                array_map(fn($awardData) => Award::create($awardData), $awards);

                $newFilePath = $patternPath['value'] . '/' . $patternFileName['value'] . '_' . Carbon::now()->toDateTimeString(). '.csv';

                Storage::move($filePath, $newFilePath);

                $this->fileService->logSuccess($filePath, count($awards));
            } catch (\Exception $e) {
                Log::error("Something wrong with data: " . $e->getMessage());
                $this->fileService->logError($filePath);
            }
        }
        $this->info('CSV files processed successfully');
    }
}
