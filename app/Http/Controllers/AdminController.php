<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\PerangkatDaerah;
use Illuminate\Support\Facades\DB;
use App\Models\KertasKerjaRenaksi;

class AdminController extends Controller
{
    public function addUserForm()
    {
        return view('admin.add-user');
    }

    public function store(Request $request)
    {
        Log::info('Data yang diterima:', ['data' => $request->all()]);
        Log::info('Route URL:', ['url' => route('admin.store')]);
        
        // Validasi input
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#.,]).+$/'
            ],
            'role' => 'required|string|in:koordinator,pelaksana',
            'perangkat_daerah_id' => 'required|exists:perangkat_daerah,id',
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki panjang minimal :min karakter.',
            'password.regex' => 'Password harus mengandung huruf, angka, dan simbol.',
        ]);
        
        Log::info('Data yang valid:', ['validatedData' => $validatedData]);

        // Simpan data ke database
        $user = new User();
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']); // Enkripsi password
        $user->role = $validatedData['role'];
        $user->perangkat_daerah_id = $validatedData['perangkat_daerah_id']; // Simpan perangkat daerah ID
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.addUserForm')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function showAddUserForm()
    {
        $perangkatDaerah = PerangkatDaerah::all(); // Ambil semua perangkat daerah dari database
        return view('admin.add-user', compact('perangkatDaerah'));
    }

    // Metode untuk view Crosscutting
    public function viewCrosscutting()
    {
        // Logika untuk menampilkan data crosscutting
        return view('admin.crosscutting');
    }

    // Metode untuk view RB Tematik
    public function viewRBTematik()
    {
        // Logika untuk menampilkan progress RB Tematik
        $rbTematikData = DB::table('kertas_kerja_renaksi')->get(); // Contoh query, sesuaikan dengan kebutuhan

        return view('admin.rb_tematik_detail', compact('rbTematikData'));
    }

    public function getRbTematikProgress(Request $request)
    {
        $year = $request->input('year');
        $quarter = $request->input('quarter');

        // Ambil data berdasarkan tahun dan triwulan
        $data = KertasKerjaRenaksi::whereYear('created_at', $year)
            ->where('quarter', $quarter)
            ->get();

        // Hitung capaian dan realisasi anggaran
        $progress = $this->calculateProgress($data);
        $budget = $this->calculateBudget($data);

        return response()->json([
            'progressPercentage' => $progress,
            'budgetPercentage' => $budget
        ]);
    }

    private function calculateProgress($data)
    {
        $totalTarget = 0;
        $totalRealisasi = 0;

        foreach ($data as $item) {
            $target = $item->target;
            $realisasi = $item->realisasi;
            $indikatorMinimum = $item->indikator_minimum; // 'Ya' atau 'Tidak'
            $konsolidasi = $item->konsolidasi; // 'Penjumlahan', 'Rata-Rata', atau 'Hasil Akhir'

            if ($konsolidasi == 'Penjumlahan') {
                $totalTarget += $target;
                $totalRealisasi += $realisasi;
            } elseif ($konsolidasi == 'Rata-Rata') {
                $totalTarget += $target;
                $totalRealisasi += $realisasi / count($data);
            } elseif ($konsolidasi == 'Hasil Akhir') {
                $totalTarget = $target; // Ambil target dari item terakhir
                $totalRealisasi = $realisasi; // Ambil realisasi dari item terakhir
            }
        }

        if ($indikatorMinimum == 'Ya') {
            $capaian = ($totalRealisasi == 0) ? 0 : ($totalTarget / $totalRealisasi) * 100;
        } else {
            $capaian = ($totalTarget == 0) ? 0 : ($totalRealisasi / $totalTarget) * 100;
        }

        return $capaian;
    }

    private function calculateBudget($data)
    {
        $totalAnggaran = 0;
        $totalRealisasi = 0;

        foreach ($data as $item) {
            $anggaran = $item->anggaran;
            $realisasi = $item->realisasi;

            $totalAnggaran += $anggaran;
            $totalRealisasi += $realisasi;
        }

        $budgetPercentage = ($totalAnggaran == 0) ? 0 : ($totalRealisasi / $totalAnggaran) * 100;

        return $budgetPercentage;
    }

    // Method to fetch available years
    public function getAvailableYears()
    {
        $years = KertasKerjaRenaksi::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');

        return response()->json([
            'years' => $years
        ]);
    }
}
