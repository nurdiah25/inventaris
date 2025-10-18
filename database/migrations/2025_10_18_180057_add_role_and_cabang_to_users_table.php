<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'role')) {
            $table->enum('role', ['superadmin', 'admin_cabang'])
                  ->default('admin_cabang')
                  ->after('email');
        }

        if (!Schema::hasColumn('users', 'cabang')) {
            $table->string('cabang')
                  ->nullable()
                  ->after('role');
        }
    });
}


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'cabang']);
        });
    }
};
