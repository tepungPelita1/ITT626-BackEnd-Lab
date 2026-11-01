<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hall_seed = [
            ['id' => '1', 'lecture_hall_name' => 'Dewan Kuliah 1', 'lecture_hall_place' => 'Blok A'],
            ['id' => '2', 'lecture_hall_name' => 'Dewan Kuliah 2', 'lecture_hall_place' => 'Blok A'],
            ['id' => '3', 'lecture_hall_name' => 'Dewan Kuliah 3', 'lecture_hall_place' => 'Blok B'],
            ['id' => '4', 'lecture_hall_name' => 'Dewan Kuliah 4', 'lecture_hall_place' => 'Blok B'],
            ['id' => '5', 'lecture_hall_name' => 'Dewan Kuliah 5', 'lecture_hall_place' => 'Blok C'],
        ];

        foreach ($hall_seed as $hall_seed) {
            Hall::firstOrCreate($hall_seed);
        }
    }
}
