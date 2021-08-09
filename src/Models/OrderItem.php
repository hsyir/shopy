<?php

namespace Hsy\Shopy\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function product()
    {
        $productModel = config("shopy.products.model");
        return $this->belongsTo($productModel);
    }
    public function order()
    {
        $orderModel = config("shopy.orders.order_model");
        return $this->belongsTo($orderModel);
    }
}
