<?php

namespace Hsy\Store\Tests;



use Hsy\Store\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Hsy\Store\Facades\Store;

class productRepositoryTest extends TestCase
{

    use RefreshDatabase;
    public function testCreateProduct()
    {
        Store::products()->store(["title"=>"new Product","body"=>"test body","category_id"=>1]);
        $this->assertCount(1,Product::all());
    }

    public function testUpdateProduct()
    {
        $product = factory(Product::class)->create();
        $newTitle = "عنوان جدید";
        $product=Store::products()->store(["title"=>$newTitle],$product);

        $this->assertEquals($product->title,$newTitle);

        $this->assertEquals(Product::all()->first()->title,$newTitle);
        $this->assertCount(1,Product::all());
        dd("asd");

    }
}
