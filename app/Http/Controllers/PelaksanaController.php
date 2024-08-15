<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PelaksanaController extends Controller
{
    public function rencanaAksi()
    {
        return view('pelaksana.rencanaAksi');
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
