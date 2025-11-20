<?php

namespace JobsLaravelPackage\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use JobsLaravelPackage\Models\AtsStage;

class AtsStagesTableSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            ['name' => 'Applied', 'slug' => 'applied', 'position' => 1, 'is_default' => true],
            ['name' => 'Screening', 'slug' => 'screening', 'position' => 2],
            ['name' => 'Interview', 'slug' => 'interview', 'position' => 3],
            ['name' => 'Offer', 'slug' => 'offer', 'position' => 4],
            ['name' => 'Hired', 'slug' => 'hired', 'position' => 5],
            ['name' => 'Rejected', 'slug' => 'rejected', 'position' => 6],
        ];

        foreach ($defaults as $stage) {
            AtsStage::firstOrCreate(
                ['slug' => $stage['slug'], 'opening_id' => null],
                [
                    'name' => $stage['name'],
                    'position' => $stage['position'],
                    'is_default' => $stage['is_default'] ?? false,
                    'slug' => Str::slug($stage['slug']),
                ]
            );
        }
    }
}
