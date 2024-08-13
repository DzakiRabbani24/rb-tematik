<?php

namespace App\Http\Controllers;

use App\Models\PerangkatDaerah;
use Illuminate\Http\Request;

class FormController extends Controller
{
    // Method untuk menampilkan form dan data perangkat daerah
    public function perangkatDaerahForm()
    {
        // Ambil semua data perangkat daerah dari database
        $perangkatDaerah = PerangkatDaerah::all();

        // Tampilkan view dengan data perangkat daerah
        return view('admin.perangkat_daerah_form', compact('perangkatDaerah'));
    }

    // Method untuk menangani submit form
    public function submitPerangkatDaerah(Request $request)
    {
        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        PerangkatDaerah::create($validatedData);

        // Redirect ke halaman form dengan pesan sukses
        return redirect()->route('admin.perangkat.daerah.form')->with('success', 'Perangkat Daerah berhasil ditambahkan!');
    }

    // Method untuk menampilkan halaman edit perangkat daerah
    public function editPerangkatDaerah($id)
    {
        // Cari perangkat daerah berdasarkan ID
        $daerah = PerangkatDaerah::findOrFail($id);

        // Kembalikan data JSON untuk AJAX request
        return response()->json($daerah);
    }

    // Method untuk mengupdate data perangkat daerah
    public function updatePerangkatDaerah(Request $request)
    {
        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'id' => 'required|integer|exists:perangkat_daerah,id',
            'nama' => 'required|string|max:255',
        ]);

        // Update data di database
        PerangkatDaerah::where('id', $validatedData['id'])->update([
            'nama' => $validatedData['nama']
        ]);

        // Redirect ke halaman form dengan pesan sukses
        return redirect()->route('admin.perangkat.daerah.form')->with('success', 'Perangkat Daerah berhasil diupdate!');
    }

    // Method untuk menghapus perangkat daerah
    public function deletePerangkatDaerah($id)
    {
        $perangkatDaerah = PerangkatDaerah::findOrFail($id);
        $perangkatDaerah->delete();

        return redirect()->route('admin.perangkat.daerah.form')->with('success', 'Data berhasil dihapus.');
    }
}
