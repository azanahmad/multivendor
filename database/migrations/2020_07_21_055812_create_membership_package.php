<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_package', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('package_name')->nullable();
            $table->bigInteger('no_products_allow')->nullable();
            $table->string('rates')->nullable();
            $table->string('plan_description')->nullable();
            $table->string('type')->nullable();
            $table->string('paypal_plan_id')->nullable();
            $table->string('strip_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('membership_package');
    }
}
