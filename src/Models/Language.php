<?php

namespace DazzaDev\Languages\Models;

use DazzaDev\Languages\Exceptions\InvalidCodeException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;

    // Active languages
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    // Ordered languages
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('name', 'asc');
    }

    //
    public function scopeGetByCode(Builder $query, string $code): Builder
    {
        $length = mb_strlen($code);

        // Check for 2 or 3 character code
        if ($length !== 2 && $length !== 3) {
            throw new InvalidCodeException('Invalid code length. Code must be either 2 or 3 characters.');
        }

        // Select column based on code length
        $column = $length === 3 ? 'iso3' : 'iso2';

        return $query->where($column, $code);
    }

    //
    public function scopeGetByName(Builder $query, string $langName): Builder
    {
        return $query->where('name', $langName)->orWhere('iso_name', $langName);
    }
}
