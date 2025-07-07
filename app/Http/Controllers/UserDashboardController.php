<?php

namespace App\Http\Controllers;

use App\Models\Loker; // <-- Tambahkan ini
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth' akan otomatis menggunakan guard 'web' (default)
        $this->middleware('auth');
    }

    public function index()
    {
        // Ambil data loker dari model Loker
        $lokers = Loker::latest()->get();

        // Tampilkan view dashboard milik user (bukan admin)
        // Pastikan Anda punya view di 'resources/views/dashboard.blade.php'
        return view('dashboard', compact('lokers'));
    }
}