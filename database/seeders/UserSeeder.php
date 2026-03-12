<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'       => 'Job Seeker',
                'email'      => 'jobseeker@example.com',
                'password'   => Hash::make('123321'),
                'role'       => 'jobseeker',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Employer',
                'email'      => 'employer@example.com',
                'password'   => Hash::make('123321'),
                'role'       => 'employer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Admin',
                'email'      => 'admin@example.com',
                'password'   => Hash::make('123321'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
