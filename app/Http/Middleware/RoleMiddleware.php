<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Cek apakah pengguna telah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in to access this page.');
        }

        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Cek apakah pengguna memiliki peran yang diperlukan
        if ($user->role !== $role) {
            return redirect('/')->with('error', 'You do not have access to this page.');
        }

        // Lanjutkan request
        return $next($request);
    }
}