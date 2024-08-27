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
        Schema::create('tb_users', function (Blueprint $table) {
            $table->string('id_user')->primary();
            $table->string('email_user');
            $table->string('verification_email');
            $table->longText('password');
            $table->string('nama');
            $table->string('gambar_user')->nullable();
            $table->string('ttl');
            $table->longText('alamat');
            $table->string('no_telp');
            $table->string('remember_token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_users');
    }
};
