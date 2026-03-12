<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('responses')->insert([
            [
                'user_id'    => 1,
                'vacancy_id' => 1,
                'status'     => 'sent',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
