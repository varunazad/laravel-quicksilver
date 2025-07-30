<?php

namespace Varunazad\Quicksilver\Facades;

use Illuminate\Support\Facades\Facade;

class Quicksilver extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'quicksilver';
    }
}
