<?php

namespace DazzaDev\Languages;

use Illuminate\Support\ServiceProvider;

class LanguagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
            __DIR__.'/../database/data/languages.json' => database_path('data/languages.json'),
            __DIR__.'/../database/seeders/' => database_path('seeders'),
        ], 'laravel-languages');
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->singleton('laravel-languages', function () {
            return new Languages;
        });
    }
}
