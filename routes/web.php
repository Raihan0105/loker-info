<?php

use Illuminate\Support\Facades\Route;

// Controller untuk Admin
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\LokerController; // Controller Loker untuk Admin

// Controller untuk User
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;


// --- RUTE LANDING PAGE & USER ---
Route::get('/', function () {
    // Jika belum login, tampilkan halaman login user
    return redirect()->route('login');
});

// Autentikasi User Biasa
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rute untuk user yang sudah login (Guard: web)
Route::middleware('auth')->group(function () {
    // Route ini akan ditangani oleh HomeController dan menampilkan dashboard.blade.php
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
});


// --- RUTE KHUSUS ADMIN ---
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Rute Login Admin
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [LokerController::class, 'index'])->name('dashboard');
    Route::get('/tambah', [LokerController::class, 'create'])->name('tambah');
    Route::post('/store', [LokerController::class, 'store'])->name('store');
    Route::get('/lokers/tersedia', [LokerController::class, 'tersedia'])->name('lokers.tersedia');
    Route::get('/lokers/selesai', [LokerController::class, 'selesai'])->name('lokers.selesai');

    // --- TAMBAHKAN RUTE-RUTE BARU DI SINI ---
    Route::put('/lokers/{loker}', [LokerController::class, 'update'])->name('lokers.update');
    Route::delete('/lokers/{loker}', [LokerController::class, 'destroy'])->name('lokers.destroy');
    Route::patch('/lokers/{loker}/selesai', [LokerController::class, 'markAsSelesai'])->name('lokers.markAsSelesai');
    
    // Rute untuk arsip
    Route::get('/lokers/trash', [LokerController::class, 'trash'])->name('lokers.trash');
    Route::post('/lokers/trash/{id}/restore', [LokerController::class, 'restore'])->name('lokers.restore');
    Route::delete('/lokers/trash/{id}/force-delete', [LokerController::class, 'forceDelete'])->name('lokers.forceDelete');
    });
});