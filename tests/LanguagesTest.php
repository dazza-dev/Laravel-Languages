<?php

namespace DazzaDev\Languages\Tests;

use DazzaDev\Languages\Facades\Languages;

class LanguagesTest extends TestCase
{
    /**
     * Test get all languages.
     */
    public function test_it_can_get_all_languages()
    {
        $languages = Languages::all();

        $this->assertCount(184, $languages);
        $this->assertEquals('English', $languages->where('iso2', 'en')->first()->name);
    }

    /**
     * Test get all active languages.
     */
    public function test_it_can_get_all_active_languages()
    {
        Languages::activate('en');
        $activeLanguages = Languages::active();

        $this->assertCount(1, $activeLanguages);
        $this->assertEquals('English', $activeLanguages->first()->name);
    }

    /**
     * Test get a language by code.
     */
    public function test_it_can_get_a_language_by_code()
    {
        $language = Languages::getByCode('en');

        $this->assertNotNull($language);
        $this->assertEquals('English', $language->name);
    }

    /**
     * Test get a language by non-existent code.
     */
    public function test_it_returns_null_for_nonexistent_language_code()
    {
        $language = Languages::getByCode('non');

        $this->assertNull($language);
    }

    /**
     * Test deactivate a language.
     */
    public function test_it_can_deactivate_a_language()
    {
        Languages::deactivate('en');
        $language = Languages::getByCode('en');

        $this->assertEquals(0, $language->active);
    }
}
