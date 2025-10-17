<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('id_barang');
            $table->unsignedBigInteger('id_cabang');
            $table->string('nama_barang');
            $table->integer('harga');
            $table->integer('stok');
            $table->timestamps();

            $table->foreign('id_cabang')
                  ->references('id_cabang')
                  ->on('cabangs')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
