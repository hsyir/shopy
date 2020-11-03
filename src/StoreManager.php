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
        $this->invoices = new invoices();
    }

    public function products()
    {
        return $this->products->reset();
    }

    public function cart()
    {
        return $this->cart;
    }

    public function invoices()
    {
        return $this->invoices;
    }
}
