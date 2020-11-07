<?php

namespace Hsy\Shopy\Classes;

use Hsy\Shopy\Models\Order;
use Hsy\Shopy\Traits\QueriesTrait;

class Orders
{
    use QueriesTrait;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->with = [];
        $this->withCount = [];
        $productModel = config('shopy.orders.model');
        $this->query = $productModel::query();

        return $this;
    }


    public function getByUniqueCode($uniqueCode)
    {
        return Order::whereUniqueCode($uniqueCode)->first();
    }
}
