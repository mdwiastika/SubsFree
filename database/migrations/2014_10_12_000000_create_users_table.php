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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('no_telp');
            $table->enum('level_user', ['Super Admin', 'Admin', 'Mitra', 'Pengguna']);
            $table->enum('level_subscription', ['Class 1', 'Class 2', 'Class 3']);
            $table->enum('status_user', ['Aktif', 'Non-Aktif']);
            $table->text('bukti_keaslian')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
