<?php

namespace Database\Seeders;

use DazzaDev\Languages\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/languages.json');

        // Check if JSON file exists
        if (! File::exists($jsonPath)) {
            $this->command->error('Languages JSON file not found.');

            return;
        }

        // Get JSON data
        $currentTimestamp = now();
        $languages = json_decode(File::get($jsonPath), true);

        // Map JSON data to Language model
        $languages = collect($languages)->map(fn ($language) => [
            'iso_name' => $language['iso_name'],
            'name' => $language['name'],
            'iso2' => $language['iso2'],
            'iso3' => $language['iso3'],
            'created_at' => $currentTimestamp,
            'updated_at' => $currentTimestamp,
        ]);

        // Truncate and Insert languages
        if ($languages->count() > 0) {
            Language::truncate();
            Language::insert($languages->toArray());
            $this->command->info('Languages data seeded successfully.');
        } else {
            $this->command->error('No data found in the JSON file.');
        }
    }
}
