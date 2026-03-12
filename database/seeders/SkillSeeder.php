<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('skills')->insert([
            [
                'name'       => 'php',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'js',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'mysql',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'git',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
