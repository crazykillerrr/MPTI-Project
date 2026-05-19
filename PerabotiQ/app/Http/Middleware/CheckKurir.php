<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckKurir
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'kurir') {
            return redirect('/login')->with('error', 'Akses ditolak.');
        }
        return $next($request);
    }
}
