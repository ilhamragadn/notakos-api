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
            $table->integer('nominal_uang_masuk');
            $table->enum('kategori_uang_masuk', ['Cash', 'Cashless'])->default('Cash');
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
        Schema::dropIfExists('catatan_pemasukans');
    }
};
