<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            StatisticSeeder::class,
            LatestPostSeeder::class,
            GallerySeeder::class,
            HomeHeroSeeder::class,
            LeaderSeeder::class,
            MissionVisionSeeder::class,
            MedicineDepartmentSeeder::class,
            NursingDepartmentSeeder::class,
            ResearchProjectsSeeder::class,
            HealthTipsSeeder::class,
            PartnerCategorySeeder::class,
            AlumniSeeder::class,
        ]);
    }
}
