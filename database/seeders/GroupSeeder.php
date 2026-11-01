<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group_seed = [
            ['id' => '1', 'name' => 'Group A', 'part' => '1'],
            ['id' => '2', 'name' => 'Group B', 'part' => '2'],
            ['id' => '3', 'name' => 'Group C', 'part' => '3'],
            ['id' => '4', 'name' => 'Group D', 'part' => '4'],
            ['id' => '5', 'name' => 'Group E', 'part' => '5'],
        ];

        foreach ($group_seed as $group_seed) {
            Group::firstOrCreate($group_seed);
        }
    }
}
