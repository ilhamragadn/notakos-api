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
        Schema::create('catatan_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('harga_barang');
            $table->integer('satuan_barang');
            $table->integer('nominal_uang_keluar');
            $table->string('jenis_kebutuhan');
            $table->enum('kategori_uang_keluar', ['Cash', 'Cashless'])->default('Cash');
            $table->unsignedBigInteger('catatan_id');
            $table->foreign('catatan_id')->references('id')->on('catatans')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_pengeluarans');
    }
};
