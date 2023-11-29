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
            $table->text('logo_company')->nullable();
            $table->text('banner_company')->nullable();
            $table->text('video_company')->nullable();
            $table->longText('about_company');
            $table->integer('pembayaran_level_1');
            $table->integer('pembayaran_level_2');
            $table->integer('pembayaran_level_3');
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
