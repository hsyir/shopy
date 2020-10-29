<?php


namespace Hsy\Store;


class Products
{
    public function store($data, $product = null)
    {
        $productModel = config("store.products.model");

        $product = ($product instanceof $productModel) ? $product : new $productModel;

        $product->fill($data);
        $product->save();

        return $product;

    }
}