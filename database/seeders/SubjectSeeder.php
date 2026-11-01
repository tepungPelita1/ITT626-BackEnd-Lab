<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subject_seed = [
            ['id' => '1', 'subject_code' => 'CSC101', 'subject_name' => 'Programming Fundamentals', 'lecturer_name' => 'Dr. Ahmad'],
            ['id' => '2', 'subject_code' => 'CSC102', 'subject_name' => 'Data Structures', 'lecturer_name' => 'Dr. Siti'],
            ['id' => '3', 'subject_code' => 'CSC103', 'subject_name' => 'Database Systems', 'lecturer_name' => 'Dr. Lee'],
            ['id' => '4', 'subject_code' => 'CSC104', 'subject_name' => 'Web Development', 'lecturer_name' => 'Dr. Kumar'],
            ['id' => '5', 'subject_code' => 'CSC105', 'subject_name' => 'Operating Systems', 'lecturer_name' => 'Dr. Fatimah'],
        ];

        foreach ($subject_seed as $subject_seed) {
            Subject::firstOrCreate($subject_seed);
        }
    }
}
