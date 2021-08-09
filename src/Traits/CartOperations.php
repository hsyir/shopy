<?php

namespace Hsy\Shopy\Traits;

use Gloudemans\Shoppingcart\Facades\Cart;
use Hsy\Store\Models\ProductVariety;

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
    public function sumarize()
    {
        $content = Cart::content();
        $product = config("shopy.products.model");
        $products = $product::with("media")->whereIn("id", $content->pluck("id"))->get()->keyBy("id");
        $content = $content->map(function ($item) use ($products) {
            $newItem = (array)$item;
            $newItem["unit"] = $products[$item->id]->unit;
            $newItem["imageUrl"] = $products[$item->id]->getFirstMediaUrl("image");
            $newItem["productUrl"] = $products[$item->id]->url;
            $newItem["availableQty"] = $products[$item->id]->available_quantity;
            return $newItem;
        });

        return [
            "items" => $content,
            "total" => Cart::total(0),
            "subtotal" => Cart::subtotal(0),
            "count" => Cart::count(),
        ];
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
        return (int)Cart::priceTotal(0, '', '');
    }
}
