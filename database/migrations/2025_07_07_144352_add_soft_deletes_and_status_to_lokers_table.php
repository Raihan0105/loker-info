<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lokers', function (Blueprint $table) {
            // Untuk menandai lowongan sudah selesai atau belum
            $table->string('status')->default('tersedia')->after('deskripsi');
            // Untuk fitur soft delete
            $table->softDeletes()->after('updated_at');
        });
    }

    public function down(): void
    {
        Schema::table('lokers', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropSoftDeletes();
        });
    }
};