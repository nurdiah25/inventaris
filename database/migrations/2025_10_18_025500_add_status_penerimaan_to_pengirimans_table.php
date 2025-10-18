<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('pengirimans', function (Blueprint $table) {
        $table->string('status_penerimaan')->nullable()->after('status_pengiriman');
    });
}

public function down()
{
    Schema::table('pengirimans', function (Blueprint $table) {
        $table->dropColumn('status_penerimaan');
    });
}

};
