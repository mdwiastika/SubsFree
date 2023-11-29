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
        Schema::create('category_rooms', function (Blueprint $table) {
            $table->id('id_category_room');
            $table->string('name_category_room');
            $table->text('icon_category_room');
            $table->string('slug_category_room')->nullable();
            $table->timestamps();
        });
        // Tempat, Jenis (Villa Apart, Hotel), Kelas (Kelas 1, Kelas 2, Kelas 3)
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_rooms');
    }
};
