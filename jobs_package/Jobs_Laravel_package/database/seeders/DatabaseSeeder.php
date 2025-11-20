<?php

namespace JobsLaravelPackage\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategoriesTableSeeder::class,
            LocationsTableSeeder::class,
            ExpertLevelsTableSeeder::class,
            QualificationsTableSeeder::class,
            AtsStagesTableSeeder::class,
            SkillTagsTableSeeder::class,
        ]);
    }
}
