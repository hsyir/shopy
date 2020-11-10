<?php

namespace Hsy\Shopy\Facades;

use Hsy\Shopy\Classes\Orders;
use Hsy\Shopy\Classes\Products;
use Hsy\Shopy\Classes\ShoppingCart;
use Illuminate\Support\Facades\Facade;

/**
 * Class Shopy
 * @package Hsy\Shopy\Facades
 *
 * @method static Products products()
 * @method static ShoppingCart cart()
 * @method static Orders orders()
 */
class Shopy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Shopy';
    }
}
