<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // tambahkan kolom role dan cabang
            $table->string('role')->default('admin_cabang'); // superadmin, admin_cabang
            $table->string('cabang')->nullable(); // banjarbaru, martapura, lianganggang
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'cabang']);
        });
    }
};
