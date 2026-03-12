<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('work_experiences')->insert([
            [
                'resume_id'    => 1,
                'position_id'  => 1,
                'company_name' => 'СС',
                'start_date'   => '2026-01-01',
                'end_date'     => '2026-02-01',
                'description'  => 'разработка и поддержка внутренних сервисов.',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
