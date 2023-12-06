<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_subscriptions', function (Blueprint $table) {
            $table->id('id_transaction_subscription');
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('checkout_link')->nullable();
            $table->string('external_id');
            $table->string('payment_type')->nullable();
            $table->string('status');
            $table->string('amount');
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
        Schema::dropIfExists('transaction_subscriptions');
    }
};
