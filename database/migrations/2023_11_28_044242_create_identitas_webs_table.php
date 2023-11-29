<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('identitas_webs', function (Blueprint $table) {
            $table->id('id_identitas_web');
            $table->string('name_company');
            $table->string('no_wa_company');
            $table->string('address_company');
            $table->string('email_company');
            $table->string('twitter_company');
            $table->string('facebook_company');
            $table->string('instagram_company');
            $table->text('logo_company')->nullable();
            $table->text('banner_company')->nullable();
            $table->string('title_banner_company')->nullable();
            $table->text('video_company')->nullable();
            $table->integer('payment_class_1');
            $table->integer('payment_class_2');
            $table->integer('payment_class_3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_webs');
    }
};
