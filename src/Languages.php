<?php

namespace DazzaDev\Languages;

use DazzaDev\Languages\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class Languages
{
    /**
     * Get all languages.
     */
    public function all(): Collection
    {
        return Language::ordered()->get();
    }

    /**
     * Get all active languages.
     */
    public function active(): Collection
    {
        return Language::active()->ordered()->get();
    }

    /**
     * Get a language by code.
     */
    public function getByCode(string $code): ?Language
    {
        return Language::getByCode($code)->first();
    }

    /**
     * Get a language by name.
     */
    public function getByName(string $langName): ?Language
    {
        return Language::getByName($langName)->first();
    }

    /**
     * Activate a language.
     */
    public function activate(string $codeOrName): void
    {
        if (mb_strlen($codeOrName) > 3) {
            $lang = Language::getByName($codeOrName);
        } else {
            $lang = Language::getByCode($codeOrName);
        }

        $lang->update(['active' => true]);
    }

    /**
     * Deactivate a language.
     */
    public function deactivate(string $codeOrName): void
    {
        if (mb_strlen($codeOrName) > 3) {
            $lang = Language::getByName($codeOrName);
        } else {
            $lang = Language::getByCode($codeOrName);
        }

        $lang->update(['active' => false]);
    }
}
