<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("user_id")->nullable();
            $table->bigInteger("total_amount");
            $table->bigInteger("discount_amount");
            $table->bigInteger("payable_amount");
            $table->dateTime("paid_at")->nullable();
            $table->string("customer_name")->nullable();
            $table->string("customer_address")->nullable();
            $table->string("customer_tell")->nullable();
            $table->string("customer_email")->nullable();
            $table->json("extra_information")->nullable();
            $table->string("unique_code")->unique();
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
        Schema::dropIfExists('invoices');
    }
}
