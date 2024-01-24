<?php

namespace App\Console;

use App\Models\Settings;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $loadScheduleTime = Settings::where('key', 'load_schedule')->first();
        $loadEnabled = Settings::where('key', 'load_enabled')->first();

        if ($loadEnabled['value']) {
            $schedule->command('csv:process')->at($loadScheduleTime['value']);
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
