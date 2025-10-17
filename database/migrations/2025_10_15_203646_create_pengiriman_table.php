<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->bigIncrements('id_pengiriman');
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('id_cabang');
            $table->integer('jumlah');
            $table->date('tanggal_pengiriman');
            $table->enum('status_pengiriman', ['Dikemas', 'Dikirim', 'Terkirim'])->default('Dikemas');
            $table->timestamps();

            $table->foreign('id_barang')->references('id_barang')->on('barangs')->onDelete('cascade');
            $table->foreign('id_cabang')->references('id_cabang')->on('cabangs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
