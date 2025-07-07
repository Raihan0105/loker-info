<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek secara spesifik: Jika guard 'admin' sudah login...
        if (Auth::guard('admin')->check()) {
            // ...maka langsung arahkan ke dashboard admin.
            return redirect()->route('admin.dashboard');
        }

        // Jika tidak, izinkan untuk melanjutkan ke halaman login admin.
        return $next($request);
    }
}
