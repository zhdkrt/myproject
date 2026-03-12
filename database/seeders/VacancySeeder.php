<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vacancies')->insert([
            [
                'company_id'  => 1,
                'category_id' => 1,
                'position_id' => 1,
                'title'       => 'PHP-разработчик',
                'description' => 'разработка и поддержка веб-приложений.',
                'salary_min'  => 1500,
                'salary_max'  => 2500,
                'status'      => 'active',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
