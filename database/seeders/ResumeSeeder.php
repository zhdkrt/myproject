<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resumes')->insert([
            [
                'user_id'             => 1,
                'desired_position_id' => 1,
                'about_me'            => 'опыт разработки на PHP.',
                'created_at'          => now(),
                'updated_at'          => now(),
            ],
        ]);
    }
}
