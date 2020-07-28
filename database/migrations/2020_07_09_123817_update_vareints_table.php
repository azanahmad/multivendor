<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVareintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vareints', function (Blueprint $table) {
            $table->string('Title')->after('Option3')->nullable();
            $table->string('Price')->after('Title')->nullable();
            $table->string('Quantity')->after('Price')->nullable();
            $table->string('SKU')->after('Quantity')->nullable();
            $table->string('Barcode')->after('SKU')->nullable();
            $table->string('Image')->after('Barcode')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vareints', function (Blueprint $table) {
            //
        });
    }
}
