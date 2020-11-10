<?php

namespace Hsy\Shopy;

use Hsy\Shopy\Classes\Orders;
use Hsy\Shopy\Classes\Products;
use Hsy\Shopy\Classes\ShoppingCart;

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
