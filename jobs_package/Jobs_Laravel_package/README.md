# Jobs Laravel Package

This package extracts the jobs module from the `jobi` application and makes it installable as a reusable Laravel package. It ships with migrations, seeders, controllers, routes, and Blade templates for job listings, applications, and taxonomy endpoints.

## Installation

1. Add the package as a path repository in your host application's `composer.json`:

```json
"repositories": [
  {
    "type": "path",
    "url": "../jobs_package/Jobs_Laravel_package"
  }
]
```

2. Require it from your Laravel app:

```bash
composer require jobs/package-laravel:dev-main
```

3. Publish and run migrations and seeders:

```bash
php artisan vendor:publish --provider="JobsLaravelPackage\\JobsServiceProvider" --tag=jobs-config
php artisan vendor:publish --provider="JobsLaravelPackage\\JobsServiceProvider" --tag=jobs-database
php artisan migrate --path=database/migrations
php artisan db:seed --class="JobsLaravelPackage\\Database\\Seeders\\DatabaseSeeder"
```

4. Optionally publish views and translations to customise UI strings:

```bash
php artisan vendor:publish --provider="JobsLaravelPackage\\JobsServiceProvider" --tag=jobs-views
php artisan vendor:publish --provider="JobsLaravelPackage\\JobsServiceProvider" --tag=jobs-lang
```

## Features

- Jobs CRUD via REST API (`/api/jobs`) with Sanctum authentication.
- Web routes for browsing jobs, viewing details, applying, and bookmarking.
- Eloquent models for openings, categories, locations, expert levels, qualifications, and bookmarks.
- Database migrations and seeders for default taxonomies.
- Simple Blade templates for listing, detail, and apply flows.

## Configuration

The `config/jobs.php` file exposes:

- `user_model`: override the user model class name if your app uses a custom one.
- `pagination`: items per page for listings and API responses.
- `features`: toggles for high-level capabilities like ATS or interview scheduling.
- `limits`: helper limits for featured duration, locations per job, and tag count.

## Testing

After installing into a Laravel project, hit the web routes or call the API endpoints. The included seeders provide sample job categories, locations, and taxonomy data to exercise the flows.
