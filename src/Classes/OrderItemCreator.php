<?php

namespace Hsy\Shopy\Classes;

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
        $orderItemModel = config('shopy.orders.order_items_model');
        $orderItem = new $orderItemModel();
        $orderItem->product_id = $item->id;
        $orderItem->product_price = $product->price;
        $orderItem->quantity = $item->qty;
        $orderItem->order_id = $order->id;
        $orderItem->total_amount = $item->qty * $product->price;
        $orderItem->save();
    }
}
