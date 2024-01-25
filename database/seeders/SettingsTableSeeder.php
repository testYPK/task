<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    private array $settings = [
        [
            'key' => 'path',
            'label' => 'File location',
            'value' => 'csvFiles',
        ],
        [
            'key' => 'file_name_pattern',
            'label' => 'File name pattern',
            'value' => 'csv_file',
        ],
        [
            'key' => 'load_enabled',
            'label' => 'Load enabled',
            'type' => 'checkbox',
            'value' => true,
        ],
        [
            'key' => 'load_schedule',
            'label' => 'Load schedule time',
            'type' => 'time',
            'value' => '14:00',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->settings as $setting) {
            Settings::create($setting);
        }
    }
}
