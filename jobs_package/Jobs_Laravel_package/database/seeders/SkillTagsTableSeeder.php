<?php

namespace JobsLaravelPackage\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use JobsLaravelPackage\Models\SkillTag;

class SkillTagsTableSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'Laravel',
            'PHP',
            'MySQL',
            'Vue.js',
            'React',
            'Docker',
            'Kubernetes',
            'AWS',
            'REST APIs',
            'Tailwind CSS',
        ];

        foreach ($skills as $skill) {
            SkillTag::firstOrCreate(
                ['slug' => Str::slug($skill)],
                [
                    'name' => $skill,
                    'category' => 'technical',
                ]
            );
        }
    }
}
