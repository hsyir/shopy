<?php


namespace Hsy\Store;


use Hsy\Store\Models\InvoiceItem;
use Hsy\Store\Models\Product;

class InvoiceItemCreator
{

    /**
     * InvoiceItemCreator constructor.
     * @param $item
     * @param $invoice
     */
    public function __construct($item,$invoice)
    {
        $product = $item->options->product;
        $invoiceItem = new InvoiceItem();
        $invoiceItem->product_id = $item->id;
        $invoiceItem->product_price = $product->price;
        $invoiceItem->quantity = $item->qty;
        $invoiceItem->invoice_id = $invoice->id;
        $invoiceItem->total_amount = $item->qty * $product->price;
        $invoiceItem->save();
    }
}