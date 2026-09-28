<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Middleware untuk cek role user (siswa/pembina)
// Alur: request masuk -> cek login -> cek role sesuai -> izinkan akses atau tolak (403)
class RoleMiddleware
{
    // Method handle: cek apakah user sudah login dan rolenya sesuai parameter
    // Params: $request (HTTP request), $next (lanjut ke controller), $role (role yang dibutuhkan: 'siswa' atau 'pembina')
    // Return: lanjut ke controller jika role cocok, atau abort 403 jika tidak cocok
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika user belum login atau role tidak cocok, tolak akses
        if (!auth()->check() || auth()->user()->role !== $role) {
            return abort(403, 'Unauthorized action.');
        }

        // Jika lolos, lanjutkan request ke controller
        return $next($request);
    }
}
