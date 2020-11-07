<?php

namespace Hsy\Store\Tests;

use Hsy\Store\Facades\Store;
use Hsy\Store\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class OnlyTest extends TestCase
{
    public function testFoo()
    {
        Http::fake([
            // Stub a JSON response for GitHub endpoints...
            'github.com/*' => Http::response(['foo' => 'bar'], 200, ['Headers']),
        ]);

        $res = Http::get("'github.com/");

   }
}
