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
        $orderModel = config('shopy.orders.orders_model');
        $this->query = $orderModel::query();

        return $this;
    }

    public function getByUniqueCode($uniqueCode)
    {
        return Order::whereUniqueCode($uniqueCode)->first();
    }

}
