<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pastikan pengguna sudah login
        if (!auth()->check()) {
            return redirect('/login'); 
        }

        $user = auth()->user();

        if ($user->hasRole($role)) {
            return $next($request);
        }

        // Jika tidak memiliki role yang sesuai, kembalikan 403 Unauthorized
        abort(403, 'Anda tidak memiliki akses untuk halaman ini.');
    }
}