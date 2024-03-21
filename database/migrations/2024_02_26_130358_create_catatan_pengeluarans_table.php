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
            $table->string('gambar');
            $table->string('judul');
            $table->string('deskripsi')->nullable();
            $table->string('jenis_pengeluaran');
            $table->string('nama_barang');
            $table->integer('harga_barang');
            $table->integer('satuan_barang');
            $table->integer('uang_keluar');
            $table->string('sumber_uang_keluar');
            $table->enum('kategori_uang_keluar', ['Cash', 'Cashless']);
            $table->integer('total_uang_keluar');
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
