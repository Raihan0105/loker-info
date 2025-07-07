<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek jika pengguna sudah login DAN rolenya adalah 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            // Jika benar, izinkan akses ke halaman selanjutnya
            return $next($request);
        }

        // Jika tidak, kembalikan ke halaman login dengan pesan error
        return redirect('/login')->withErrors(['email' => 'Anda tidak memiliki hak akses untuk halaman ini.']);
    }
}