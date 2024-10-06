<?php

namespace DazzaDev\Languages\Tests;

use DazzaDev\Languages\LanguagesServiceProvider;
use DazzaDev\Languages\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Get package providers.
     */
    protected function getPackageProviders($app)
    {
        return [
            LanguagesServiceProvider::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Migrate
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->artisan('migrate')->run();
        $this->loadDataFromJson();
    }

    protected function loadDataFromJson()
    {
        $jsonPath = __DIR__.'/../database/data/languages.json';

        // Check if JSON file exists
        if (File::exists($jsonPath)) {
            $languages = json_decode(File::get($jsonPath), true);
            Language::insert($languages);
        } else {
            throw new \Exception("JSON file not found at: $jsonPath");
        }
    }
}
