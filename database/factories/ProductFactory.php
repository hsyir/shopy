<?php

use Hsy\Store\Models\Product;

$factory->define(Product::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->sentence,
        'slug'        => \Illuminate\Support\Str::slug($faker->sentence),
        'description' => $faker->sentence,
        'category_id' => 1,
        'weight'      => $faker->randomNumber(3) * 100,
        'price'       => $faker->randomNumber(3) * 1000,
        'extra_data'  => [
            'key1' => $faker->randomNumber(),
            'key2' => $faker->sentence(),
            'key3' => $faker->name(),
        ],
    ];
});
