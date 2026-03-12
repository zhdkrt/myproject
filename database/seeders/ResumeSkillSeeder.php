<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResumeSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resume_skills')->insert([
            [
                'resume_id'  => 1,
                'skill_id'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'resume_id'  => 1,
                'skill_id'   => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
