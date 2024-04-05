<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Superhero;

class SuperheroesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Superhero::truncate();
        $csvData = fopen(base_path('database/csv/superheros.csv'), 'r');
        $transRow = true;
        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if (!$transRow) {
                Superhero::create([
                    'id'=> $data['0'],
                    'name'=> $data['1'],
                    'fullName'=> $data['2'],
                    'strength'=> $data['3'],
                    'speed'=> $data['4'],
                    'durability'=> $data['5'],
                    'power'=> $data['6'],
                    'combat'=> $data['7'],
                    'race'=> $data['8'],
                    'height/0'=> $data['9'],
                    'height/1'=> $data['10'],
                    'weight/0'=> $data['11'],
                    'weight/1'=> $data['12'],
                    'eyeColor'=> $data['13'],
                    'hairColor'=> $data['14'],
                    'publisher'=> $data['15'],
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
