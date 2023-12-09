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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('id_room');
            $table->foreignId('category_room_id')->constrained('category_rooms', 'id_category_room')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->string('name_room');
            $table->string('slug_room')->nullable();
            $table->string('location_room');
            $table->longText('photo_room')->nullable();
            $table->longText('description_room');
            $table->enum('level_room', ['Class 1', 'Class 2', 'Class 3']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
