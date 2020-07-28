<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_status')->nullable();
            $table->string('stripe_plan')->nullable();
            $table->integer('quantity')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->string('paypal_status')->nullable();
            $table->string('paypal_subscription_id')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('paypal_subscription_starts_at')->nullable();
            $table->string('paypal_active_subscription')->nullable();
            $table->string('pay_pal_plan_id')->nullable();
            $table->integer('paypal')->nullable();
            $table->integer('strip')->nullable();
            $table->integer('plan_id')->nullable();
            $table->timestamps();




            $table->index(['user_id', 'stripe_status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
