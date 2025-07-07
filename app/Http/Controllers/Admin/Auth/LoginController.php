<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // --- PERBAIKI BAGIAN INI ---
        // Ganti dari $this->validate() menjadi $request->validate()
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);
        // --- AKHIR PERBAIKAN ---

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin/dashboard');
        }
        
        return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Email atau Password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect('/admin/login');
    }
}
