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
        Schema::create('tb_kategori_pemasukan', function (Blueprint $table) {
            $table->string('kategori_pemasukan_id')->primary();
            $table->string('nama_pemasukan');
            $table->string('id_user');
            $table->string('deskripsi_kategori_pemasukan');
            $table->string('icon_pemasukan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kategori_pemasukan');
    }
};
