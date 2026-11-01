<?php

namespace Database\Seeders;

use App\Models\Timetable;
use Illuminate\Database\Seeder;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timetable_seed = [
            ['id' => '1', 'user_id' => '1', 'subject_id' => '1', 'day_id' => '1', 'hall_id' => '1', 'group_id' => '1', 'time_from' => '08:00', 'time_to' => '10:00'],
            ['id' => '2', 'user_id' => '1', 'subject_id' => '2', 'day_id' => '2', 'hall_id' => '2', 'group_id' => '2', 'time_from' => '10:00', 'time_to' => '12:00'],
            ['id' => '3', 'user_id' => '2', 'subject_id' => '3', 'day_id' => '3', 'hall_id' => '3', 'group_id' => '3', 'time_from' => '14:00', 'time_to' => '16:00'],
            ['id' => '4', 'user_id' => '2', 'subject_id' => '4', 'day_id' => '4', 'hall_id' => '4', 'group_id' => '4', 'time_from' => '09:00', 'time_to' => '11:00'],
            ['id' => '5', 'user_id' => '1', 'subject_id' => '5', 'day_id' => '5', 'hall_id' => '5', 'group_id' => '5', 'time_from' => '15:00', 'time_to' => '17:00'],
        ];

        foreach ($timetable_seed as $timetable_seed) {
            Timetable::firstOrCreate($timetable_seed);
        }
    }
}
