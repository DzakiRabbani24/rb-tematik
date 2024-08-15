<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Kepmen;
use App\Models\User;
use App\Models\PerangkatDaerah;
use App\Models\KertasKerjaRenaksi;
use Illuminate\Support\Facades\Auth;
use App\Imports\KepmenImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function addUserForm()
    {
        $perangkatDaerah = PerangkatDaerah::all();
        $users = User::whereIn('role', ['koordinator', 'pelaksana'])
                     ->with('perangkatDaerah')
                     ->get();

        return view('admin.add-user', compact('perangkatDaerah', 'users'));
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    public function store(Request $request)
    {
        // Validasi dan simpan data user
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

        $user = new User();
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->perangkat_daerah_id = $validatedData['perangkat_daerah_id'];
        $user->save();

        return redirect()->route('admin.addUserForm')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function storeAdmin(Request $request)
    {
        // Validasi dan simpan data admin
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#.,]).+$/'
            ],
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki panjang minimal :min karakter.',
            'password.regex' => 'Password harus mengandung huruf, angka, dan simbol.',
        ]);

        $user = new User();
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.addUserForm')->with('success', 'Admin berhasil dibuat!');
    }

    // Menampilkan Kepmen
    public function showKepmen()
    {
        $kepmen = Kepmen::all();
        return view('admin.kepmen', compact('kepmen'));
    }

    // Import Kepmen
    public function importKepmen(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new KepmenImport, $request->file('file'));

            return redirect()->back()->with('success', 'File successfully imported.');
        } catch (\Exception $e) {
            Log::error('Import Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to import file.');
        }
    }

    // Metode untuk view Crosscutting
    public function viewCrosscutting()
    {
        return view('admin.crosscutting');
    }

    public function viewRBTematik()
    {
        $rbTematikData = DB::table('kertas_kerja_renaksi')->get();
        return view('admin.rb_tematik_detail', compact('rbTematikData'));
    }

    public function getRbTematikProgress(Request $request)
    {
        $year = $request->input('year');
        $quarter = $request->input('quarter');

        $data = KertasKerjaRenaksi::whereYear('created_at', $year)
            ->where('quarter', $quarter)
            ->get();

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
            $indikatorMinimum = $item->indikator_minimum;
            $konsolidasi = $item->konsolidasi;

            if ($konsolidasi == 'Penjumlahan') {
                $totalTarget += $target;
                $totalRealisasi += $realisasi;
            } elseif ($konsolidasi == 'Rata-Rata') {
                $totalTarget += $target;
                $totalRealisasi += $realisasi / count($data);
            } elseif ($konsolidasi == 'Hasil Akhir') {
                $totalTarget = $target;
                $totalRealisasi = $realisasi;
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

    public function getAvailableYears()
    {
        $years = KertasKerjaRenaksi::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');

        return response()->json([
            'years' => $years
        ]);
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

    public function index(Request $request)
    {
        $query = $request->input('search');
        $kepmen = Kepmen::query()
            ->where('tahun', 'like', "%{$query}%")
            ->orWhere('status', 'like', "%{$query}%")
            ->orWhere('U', 'like', "%{$query}%")
            ->orWhere('BU', 'like', "%{$query}%")
            ->orWhere('P', 'like', "%{$query}%")
            ->orWhere('K', 'like', "%{$query}%")
            ->orWhere('SK', 'like', "%{$query}%")
            ->orWhere('nomenklatur_urusan_kabupaten_kota', 'like', "%{$query}%")
            ->orWhere('kinerja', 'like', "%{$query}%")
            ->orWhere('indikator', 'like', "%{$query}%")
            ->get();

        return view('admin.kepmen', compact('kepmen'));
    }
}
