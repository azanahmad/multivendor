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
            $table->bigIncrements('id');
            $table->string('shopify_id')->nullable();
            $table->string('vendor_id')->nullable();;
            $table->string('Title')->nullable();;
            $table->string('Discription')->nullable();;
            $table->string('Price')->nullable();;
            $table->string('Compare_price')->nullable();;
            $table->string('Image')->nullable();;
            $table->string('SKU')->nullable();;
            $table->string('Barcode')->nullable();;
            $table->string('Quantity')->nullable();
            $table->string('Weight')->nullable();
            $table->string('County/zone')->nullable();
            $table->string('option_name1')->nullable();
            $table->string('option_name2')->nullable();
            $table->string('option_name3')->nullable();
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
