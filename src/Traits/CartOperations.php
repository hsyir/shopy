<?php

namespace Hsy\Store\Traits;

use Gloudemans\Shoppingcart\Facades\Cart;

/**
 * Trait CartOperations.
 */
trait CartOperations
{
    /**
     * @param $product
     * @param int $quantity
     */
    public function add($product, $quantity = 1)
    {
        Cart::add($product, $quantity);
    }

    /**
     * @return mixed
     */
    public function content()
    {
        return Cart::content();
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return Cart::count();
    }

    /**
     * @param $rowId
     * @param $data
     */
    public function update($rowId, $data)
    {
        Cart::update($rowId, $data);
    }

    public function destroyCart()
    {
        Cart::destroy();
    }

    /**
     * @return int
     */
    public function priceTotal()
    {
        return (int) Cart::priceTotal(0, '', '');
    }
}
