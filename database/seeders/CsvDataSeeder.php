<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CsvData;

class CsvDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CsvData::create([
            'keyName' => env('FILE_KEY_NAME'),
            'url' => env('CSV_URL')
        ]);
    }
}
