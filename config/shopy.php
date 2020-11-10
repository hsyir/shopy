<?php

return [
    'products'=> [
        'model'=> \Hsy\Shopy\Models\Product::class,
    ],
    'orders'=> [
        'orders_model'=> \Hsy\Shopy\Models\Order::class,
        'order_items_model'=> \Hsy\Shopy\Models\OrderItem::class,
    ],
];
