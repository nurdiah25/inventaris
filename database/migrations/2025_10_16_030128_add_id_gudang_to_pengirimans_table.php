<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengirimans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_gudang')->nullable()->after('id_pengiriman');
            $table->foreign('id_gudang')->references('id_gudang')->on('gudangs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('pengirimans', function (Blueprint $table) {
            $table->dropForeign(['id_gudang']);
            $table->dropColumn('id_gudang');
        });
    }
};
