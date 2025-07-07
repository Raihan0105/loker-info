<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loker extends Model
{
    use SoftDeletes; // <-- TAMBAHKAN INI
    
    // Tambahkan 'tgl_tutup' di sini
    protected $fillable = ['judul', 'perusahaan', 'deskripsi', 'gambar_url', 'tgl_tutup'];

    // Tambahan: Agar kolom tgl_tutup otomatis dianggap sebagai objek tanggal
    protected $casts = [
        'tgl_tutup' => 'date',
    ];
}
