<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Jika role tidak cocok, arahkan kembali
        if (!$user->hasRole($role)) {
            // Jika admin tapi akses ke halaman user → arahkan ke dashboard admin
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }

            // Jika user tapi akses ke halaman admin → arahkan ke dashboard user
            if ($user->isRegularUser()) {
                return redirect()->route('user.dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }

            // Jika tidak cocok keduanya
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
