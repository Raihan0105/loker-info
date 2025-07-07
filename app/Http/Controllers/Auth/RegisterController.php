<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /**
     * Tampilkan form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    
    /**
     * Tangani permintaan registrasi.
     */
    public function register(Request $request)
    {
        // 1. Validasi semua input
        $this->validator($request->all())->validate();

        // 2. Buat pengguna baru
        $user = $this->create($request->all());

        // 3. Kirim event bahwa pengguna telah terdaftar (opsional, tapi bagus untuk notifikasi email dll)
        event(new Registered($user));

        // 4. Alihkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun Anda berhasil dibuat! Silakan login.');
    }

    /**
     * Dapatkan validator untuk permintaan registrasi.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Buat instance User baru setelah registrasi yang valid.
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // Role otomatis menjadi 'user' sesuai default di database
        ]);
    }
}