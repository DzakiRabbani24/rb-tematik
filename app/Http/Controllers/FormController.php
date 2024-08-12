<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDaerah;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Method untuk menampilkan form
    public function perangkatDaerahForm()
    {
        return view('admin.perangkat_daerah_form');
    }

    // Method untuk menangani submit form
    public function submitPerangkatDaerah(Request $request)
    {
        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan data ke database atau lakukan aksi lain
        PerangkatDaerah::create($validatedData);

        // Redirect ke halaman lain atau kembalikan ke halaman form dengan pesan sukses
        return redirect()->route('admin.perangkat.daerah.form')->with('success', 'Perangkat Daerah berhasil ditambahkan!');
    }
}