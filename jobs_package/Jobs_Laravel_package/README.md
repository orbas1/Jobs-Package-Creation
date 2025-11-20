# Jobs Laravel Package

This package packages the core jobs, applications, and applicant tracking features from the Jobi platform so they can be reused inside other Laravel applications.

## Installation

1. Add the package as a path repository in your root `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "jobs_package/Jobs_Laravel_package"
        }
    ]
}
```

2. Require the package:

```bash
composer require jobs/laravel-package:dev-main
```

3. Publish assets and run database migrations:

```bash
php artisan vendor:publish --provider="Jobs\\JobsServiceProvider"
php artisan migrate
```

4. (Optional) seed default ATS data:

```bash
php artisan db:seed --class="Jobs\\Database\\Seeders\\JobsDatabaseSeeder"
```

## Features

- Job postings with publishing windows and featured listings
- Company and candidate profiles
- Job applications with CV and cover letter attachments
- Applicant Tracking System stages and movement history
- Screening questions and recorded answers
- Subscription records and job credit tracking
- Interview scheduling records
- API and web routes for job browsing and management
- Blade views, translations, and configuration publishing stubs
