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
        Store::products()->store(["title" => "new Product", "body" => "test body", "category_id" => 1, "price" => 100000]);
        $this->assertCount(1, Product::all());
    }

    public function testUpdateProduct()
    {
        $product = factory(Product::class)->create();
        $newTitle = "عنوان جدید";
        Store::products()->store(["title" => $newTitle], $product);
        $this->assertEquals(Product::all()->first()->title, $newTitle);

    }

    public function testCreateWithTags()
    {
        $tags = ["foo", "bar one"];
        $data = [
            "title" => "new Product",
            "body" => "test body",
            "category_id" => 1,
            "price" => 100000,
            "tags" => $tags
        ];

        Store::products()->store($data);

        $this->assertEquals(
            Product::all()->first()->tags->pluck("name")->toArray(),
            $tags
        );

    }


}
