<?php

namespace JobsLaravelPackage;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use JobsLaravelPackage\Models\Opening;
use JobsLaravelPackage\Policies\OpeningPolicy;

class JobsServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/jobs.php', 'jobs');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jobs');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'jobs');

        $this->publishes([
            __DIR__ . '/../config/jobs.php' => config_path('jobs.php'),
        ], 'jobs-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/jobs'),
        ], 'jobs-views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/jobs'),
        ], 'jobs-lang');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
            __DIR__ . '/../database/seeders' => database_path('seeders'),
        ], 'jobs-database');

        Gate::policy(Opening::class, OpeningPolicy::class);
    }
}
