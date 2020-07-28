<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->string('payment')->nullable();
            $table->unsignedBigInteger('paypal')->nullable();
            $table->unsignedBigInteger('stripe')->nullable();
            $table->string('paypal_batch_id')->nullable();
            $table->string('status')->nullable();
            $table->string('date')->nullable();
            $table->string('tracking')->nullable();
            $table->string('notes')->nullable();


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
        Schema::dropIfExists('order_payments');
    }
}
