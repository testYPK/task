<?php

namespace App\Console\Commands;

use App\Services\FileService;
use Illuminate\Console\Command;

class ProcessCsvFilesCommand extends Command
{
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
        (new FileService())->processCsvFiles();
        $this->info('CSV files processed successfully');
    }
}
