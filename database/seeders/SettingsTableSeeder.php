<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create(
                [
                    'key' => 'path',
                    'label' => 'File location',
                    'value' => 'csvFiles'
                ]
        );

        Settings::create(
            [
                'key' => 'file_name_pattern',
                'label' => 'File name pattern',
                'value' => 'csv_file'
            ]
        );

        Settings::create(
            [
                'key' => 'load_enabled',
                'label' => 'Load enabled',
                'type' => 'checkbox',
                'value' => true,
            ]
        );

        Settings::create(
            [
                'key' => 'load_schedule',
                'label' => 'Load schedule time',
                'type' => 'time',
                'value' => '14:00',
            ]
        );
    }
}
