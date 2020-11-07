<?php

namespace Hsy\Store;

use Hsy\Store\Classes\Orders;
use Hsy\Store\Classes\Products;
use Hsy\Store\Classes\ShoppingCart;

class StoreManager
{
    private Products $products;
    private ShoppingCart $cart;
    private Orders $orders;

    public function __construct()
    {
        $this->products = new Products();
        $this->cart = new ShoppingCart();
        $this->orders = new Orders();
    }

    public function products()
    {
        return $this->products->reset();
    }

    public function cart()
    {
        return $this->cart;
    }

    public function orders()
    {
        return $this->orders;
    }
}
