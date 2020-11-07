<?php

namespace Hsy\Store\Classes;

use Hsy\Store\Facades\Store;
use Hsy\Store\Models\Order;
use Hsy\Store\Traits\CartOperations;
use Ramsey\Uuid\Uuid;

/**
 * Class ShoppingCart.
 */
class ShoppingCart
{
    use CartOperations;

    /**
     * @param array $extraData
     * @param null  $customerId
     *
     * @return Order
     */
    public function toOrder($extraData = [], $customerId = null)
    {
        $priceTotal = $this->priceTotal();
        $order = $this->createOrder($priceTotal, $customerId, $extraData);

        $this->attachProducts();
        $cartItems = $this->content();
        foreach ($cartItems as $cartItem) {
            new OrderItemCreator($cartItem, $order);
        }

        $this->destroyCart();

        return $order;
    }

    public function attachProducts()
    {
        $productsIds = $this->content()->pluck('id');
        $products = Store::products()->query()->whereIn('id', $productsIds)->get()->keyBy('id');

        $this->content()->map(function ($item) use ($products) {
            $this->update($item->rowId, ['options' => ['product' => $products[$item->id]]]);
        });
    }

    /**
     * @param int $priceTotal
     * @param $customerId
     * @param array $extraData
     *
     * @return Order
     */
    private function createOrder(int $priceTotal, $customerId, array $extraData): Order
    {
        $order = new Order();
        $order->total_amount = $priceTotal;
        $order->customer_id = $customerId;
        $order->tax_amount = 0;
        $order->discount_amount = 0;
        $order->payable_amount = $priceTotal;
        $order->extra_data = $extraData;
        $order->unique_code = Uuid::uuid4();
        $order->save();

        return $order;
    }
}
