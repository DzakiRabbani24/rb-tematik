<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PerangkatDaerah;
use App\Models\KertasKerjaRenaksi;


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
}