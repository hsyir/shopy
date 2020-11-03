<?php

namespace Hsy\Store;

use Hsy\Store\Facades\Store;
use Hsy\Store\Models\Invoice;
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
     * @return Invoice
     */
    public function toInvoice($extraData = [], $customerId = null)
    {
        $priceTotal = $this->priceTotal();
        $invoice = $this->createInvoice($priceTotal, $customerId, $extraData);

        $this->attachProducts();
        $cartItems = $this->content();
        foreach ($cartItems as $cartItem) {
            new InvoiceItemCreator($cartItem, $invoice);
        }

        $this->destroyCart();

        return $invoice;
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
     * @return Invoice
     */
    private function createInvoice(int $priceTotal, $customerId, array $extraData): Invoice
    {
        $invoice = new Invoice();
        $invoice->total_amount = $priceTotal;
        $invoice->customer_id = $customerId;
        $invoice->tax_amount = 0;
        $invoice->discount_amount = 0;
        $invoice->payable_amount = $priceTotal;
        $invoice->extra_data = $extraData;
        $invoice->unique_code = Uuid::uuid4();
        $invoice->save();

        return $invoice;
    }
}
