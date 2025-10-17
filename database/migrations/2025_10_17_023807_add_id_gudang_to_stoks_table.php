<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('stoks', function (Blueprint $table) {
        $table->unsignedBigInteger('id_gudang')->nullable()->after('id_cabang');
    });
}

public function down()
{
    Schema::table('stoks', function (Blueprint $table) {
        $table->dropColumn('id_gudang');
    });
}

};
