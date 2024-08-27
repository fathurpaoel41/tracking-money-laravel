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
        Schema::create('tb_pengeluaran', function (Blueprint $table) {
            $table->string('pengeluaran_id')->primary();
            $table->string('kategori_pengeluaran_id');
            $table->string('id_user');
            $table->string('id_dompet');
            $table->integer('total_pengeluaran');
            $table->text('deskripsi_pengeluaran');
            $table->string('gambar_pengeluaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengeluaran');
    }
};
