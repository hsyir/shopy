<?php

namespace Hsy\Store\Classes;

use Hsy\Store\Models\OrderItem;

class OrderItemCreator
{
    /**
     * InvoiceItemCreator constructor.
     *
     * @param $item
     * @param $order
     */
    public function __construct($item, $order)
    {
        $product = $item->options->product;
        $orderItem = new OrderItem();
        $orderItem->product_id = $item->id;
        $orderItem->product_price = $product->price;
        $orderItem->quantity = $item->qty;
        $orderItem->order_id = $order->id;
        $orderItem->total_amount = $item->qty * $product->price;
        $orderItem->save();
    }
}
