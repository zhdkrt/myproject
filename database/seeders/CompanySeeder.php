<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'user_id'      => 2,
                'company_name' => 'Zhdk Corp',
                'description'  => 'Большая IT-компания.',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
