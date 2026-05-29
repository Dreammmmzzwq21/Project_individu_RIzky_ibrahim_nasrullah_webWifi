<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'pelanggan') {
            return redirect()->route('login')->withErrors(['email' => 'Akses ditolak.']);
        }
        return $next($request);
    }
}