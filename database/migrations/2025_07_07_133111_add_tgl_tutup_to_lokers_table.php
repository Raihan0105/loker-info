<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lokers', function (Blueprint $table) {
            // Tambahkan kolom baru 'tgl_tutup' setelah kolom 'gambar_url'
            // Dibuat nullable agar bisa dikosongkan (opsional)
            $table->date('tgl_tutup')->nullable()->after('gambar_url');
        });
    }

    public function down(): void
    {
        Schema::table('lokers', function (Blueprint $table) {
            $table->dropColumn('tgl_tutup');
        });
    }
};
