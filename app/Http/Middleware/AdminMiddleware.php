<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika sudah login dan rolenya admin, persilakan masuk
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika pembeli biasa iseng buka URL Admin, tendang ke beranda!
        return redirect('/')->with('error', 'Akses Ditolak: Anda bukan Administrator!');
    }
}