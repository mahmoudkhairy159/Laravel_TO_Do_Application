<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'en' => [
                'title' => 'ToDo',
                'slogan' => 'ToDo',
                'summary' => 'ToDo',
            ],
            'sv' => [
                'title' => 'ToDo',
                'slogan' => 'ToDo',
                'summary' => 'ToDo',
            ],
            'ar' => [
                'title' => 'ToDo',
                'slogan' => 'ToDo',
                'summary' => 'ToDo',
            ],
        ];


        Setting::create($data);
    }
}
