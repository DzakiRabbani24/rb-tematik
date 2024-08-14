<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        // Tentukan view yang sesuai berdasarkan role
        switch ($user->role) {
            case 'admin':
                $view = 'admin.profile_admin';
                break;
            case 'koordinator':
                $view = 'koordinator.profile_koordinator';
                break;
            case 'pelaksana':
                $view = 'pelaksana.profile_pelaksana';
                break;
            // Jika role tidak cocok dengan yang ada, laravel akan gagal memuat view
        }

        // Cek jika view tidak diatur
        if (!isset($view)) {
            abort(404); // Menampilkan halaman 404 jika role tidak dikenal
        }

        return view($view, compact('user'));
    }
}
