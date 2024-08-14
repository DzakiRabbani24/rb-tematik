<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan peran pengguna yang sedang login
        $role = Auth::user()->role;

        // Mengarahkan pengguna ke dashboard berdasarkan peran mereka
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'koordinator':
                return redirect()->route('koordinator.dashboard');
            case 'pelaksana':
                return redirect()->route('pelaksana.dashboard');
            default:
                // Jika peran tidak dikenali, menampilkan pesan kesalahan
                return abort(403, 'Unauthorized');
        }
    }
}
