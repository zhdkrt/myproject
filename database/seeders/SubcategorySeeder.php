<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subcategories')->insert([
            [
                'category_id'     => 1,
                'subcategory_name'=> 'Web Development',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'category_id'     => 1,
                'subcategory_name'=> 'Mobile Development',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ]);
    }
}
