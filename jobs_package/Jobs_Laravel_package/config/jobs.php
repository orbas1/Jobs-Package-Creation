<?php

return [
    'user_model' => env('JOBS_USER_MODEL', '\\App\\Models\\User'),
    'pagination' => 12,
    'features' => [
        'ats' => true,
        'cv_builder' => true,
        'cover_letters' => true,
        'screening_questions' => true,
        'interviews' => true,
    ],
    'limits' => [
        'featured_days' => 30,
        'max_locations' => 3,
        'max_tags' => 6,
        'max_skill_tags' => 10,
    ],
];
