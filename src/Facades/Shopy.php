<?php

namespace Hsy\Shopy\Facades;

use Illuminate\Support\Facades\Facade;

class Shopy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Shopy';
    }
}
