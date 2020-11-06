<?php

namespace Hsy\Store;

class StoreManager
{
    private Products $products;
    private ShoppingCart $cart;
    private Invoices $invoices;

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
