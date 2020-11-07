<?php

namespace Hsy\Store;

use Hsy\Store\Models\Order;
use Hsy\Store\Traits\QueriesTrait;

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
        $productModel = config('store.orders.model');
        $this->query = $productModel::query();

        return $this;
    }


    public function getByUniqueCode($uniqueCode)
    {
        return Order::whereUniqueCode($uniqueCode)->first();
    }
}
