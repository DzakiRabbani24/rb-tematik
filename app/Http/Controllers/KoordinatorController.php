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
        // Logika untuk menampilkan halaman evaluasi
        return view('koordinator.roadmap');
    }
    
    public function rencanaaksi()
    {
        // Logika untuk menampilkan halaman evaluasi
        return view('koordinator.rencanaaksi');
    }

    public function updateProfile(Request $request)
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Pastikan $user tidak null dan merupakan instance dari User
        if (!$user || !$user instanceof User) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Validasi input dengan mempertimbangkan username unik kecuali untuk pengguna saat ini
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update username
        $user->username = $request->input('username');

        // Update password jika dimasukkan
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}