<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json("title");
            $table->json("body");
            $table->string("slug");
            $table->bigInteger("price");
            $table->bigInteger("no_discount_price")->nullable();
            $table->string("unit")->nullable();
            $table->bigInteger("weight")->nullable();
            $table->unsignedInteger("category_id");
            $table->unsignedInteger("user_id")->nullable();
            $table->text("extra_data")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
