<?php

namespace DazzaDev\Languages\Facades;

use Illuminate\Support\Facades\Facade;

class Languages extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-languages';
    }
}
