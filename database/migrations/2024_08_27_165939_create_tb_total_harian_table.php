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
        Schema::create('tb_total_harian', function (Blueprint $table) {
            $table->string('id_total_harian')->primary();
            $table->string('id_user');
            $table->string('id_dompet');
            $table->integer('total_pemasukan');
            $table->integer('total_pengeluaran');
            $table->dateTime('sync_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_total_harian');
    }
};
