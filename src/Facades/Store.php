<?php

namespace Hsy\Store\Facades;

use Illuminate\Support\Facades\Facade;

class Store extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Store';
    }
}
