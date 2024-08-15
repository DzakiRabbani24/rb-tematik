<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    public function evaluasi()
    {
        // Logika untuk menampilkan halaman evaluasi
        return view('koordinator.evaluasi');
    }
    
    public function roadmap()
    {
        // Logika untuk menampilkan halaman roadmap
        return view('koordinator.roadmap');
    }
    
    public function rencanaaksi()
    {
        // Logika untuk menampilkan halaman rencana aksi
        return view('koordinator.rencanaaksi');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user instanceof User) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->username = $request->input('username');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($user->save()) {
            return redirect()->back()->with('success', 'Profile berhasil diupdate.');
        } else {
            return redirect()->back()->with('error', 'Profile gagal diupdate.');
        }
    }
}
