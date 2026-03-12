<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'position_name' => 'Backend Developer',
                'seniority'     => 'Middle',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'position_name' => 'Frontend Developer',
                'seniority'     => 'Junior',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
