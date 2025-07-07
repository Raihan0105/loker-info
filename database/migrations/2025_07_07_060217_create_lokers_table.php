<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('perusahaan');
            $table->string('gambar_url')->nullable(); // langsung tambahkan kolom gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokers');
    }
};
