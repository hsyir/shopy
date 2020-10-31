<?php


namespace Hsy\Store;


class Store
{
    private Products $products;

    public function __construct()
    {
        $this->products = new Products();
    }


    public function products()
    {
        return $this->products->reset();
    }
}