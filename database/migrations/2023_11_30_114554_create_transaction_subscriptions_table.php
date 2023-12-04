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
            $table->string('transaction_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('gross_amount');
            $table->string('pdf_url')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('payment_type');
            $table->string('transaction_status');
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