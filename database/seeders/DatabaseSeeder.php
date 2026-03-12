<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            PositionSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            VacancySeeder::class,
            ResumeSeeder::class,
            SkillSeeder::class,
            ResumeSkillSeeder::class,
            WorkExperienceSeeder::class,
            FavoriteSeeder::class,
            ResponseSeeder::class,
        ]);
    }
}
