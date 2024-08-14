<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Flash message for successful login
            session()->flash('success', 'Login berhasil!');
            session()->flash('username', $user->username); // Menyimpan username di session

            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->role === 'koordinator') {
                return redirect()->intended('koordinator/dashboard');
            } elseif ($user->role === 'pelaksana') {
                return redirect()->intended('pelaksana/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        // Flash message for failed login
        return back()->withErrors([
            'username' => 'Invalid credentials.',
        ]);
    }

    // Metode logout
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}