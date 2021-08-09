<?php

namespace Hsy\Shopy\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $casts = [
        'extra_data' => 'array',
    ];

    public function items()
    {
        $orderItemModel = config("shopy.orders.order_items_model");
        return $this->hasMany($orderItemModel);
    }
}
