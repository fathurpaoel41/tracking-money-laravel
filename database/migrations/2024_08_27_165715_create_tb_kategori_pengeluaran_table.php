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
        Schema::create('tb_kategori_pengeluaran', function (Blueprint $table) {
            $table->string('kategori_pengeluaran_id')->primary();
            $table->string('nama_pengeluaran');
            $table->string('id_user');
            $table->string('deskripsi_kategori_pengeluaran');
            $table->string('icon_pengeluaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kategori_pengeluaran');
    }
};
