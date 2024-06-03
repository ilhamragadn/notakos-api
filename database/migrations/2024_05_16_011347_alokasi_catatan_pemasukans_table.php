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
        Schema::create('alokasi_pemasukans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catatan_id');
            $table->unsignedBigInteger('alokasi_id');
            $table->string('variabel_teralokasi')->nullable();
            $table->integer('saldo_teralokasi')->nullable();
            $table->timestamps();
            $table->foreign('catatan_id')->references('id')->on('catatans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('alokasi_id')->references('id')->on('alokasis')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alokasi_pemasukans');
    }
};
