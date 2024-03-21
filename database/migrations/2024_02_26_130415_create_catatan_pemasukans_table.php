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
        Schema::create('catatan_pemasukans', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('judul');
            $table->string('deskripsi')->nullable();
            $table->integer('uang_masuk');
            $table->string('sumber_uang_masuk');
            $table->enum('kategori_uang_masuk', ['Cash', 'Cashless']);
            $table->integer('total_uang_masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_pemasukans');
    }
};
