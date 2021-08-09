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
            $table->json('name');
            $table->json('description');
            $table->json('unit')->nullable();
            $table->string('slug');
            $table->integer('inventory_count')->default(-1);
            $table->bigInteger('price');
            $table->bigInteger('no_discount_price')->nullable();
            $table->bigInteger('weight')->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->json('extra_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
