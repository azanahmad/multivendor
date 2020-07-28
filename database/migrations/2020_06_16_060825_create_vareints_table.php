<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVareintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vareints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_shopify_id')->nullable();
            $table->string('shopify_id')->nullable();
            $table->Integer('product_id')->nullable();
            $table->string('Option1')->nullable();
            $table->string('Option2')->nullable();
            $table->string('Option3')->nullable();
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
        Schema::dropIfExists('vareints');
    }
}
