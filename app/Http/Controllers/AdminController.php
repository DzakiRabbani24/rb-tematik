<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PerangkatDaerah;
use App\Models\KertasKerjaRenaksi;

class AdminController extends Controller
{

    public function showUserTable()
    {
        $perangkatDaerah = PerangkatDaerah::all();
        $users = User::with('perangkatDaerah')->get();

        return view('admin.add-user', compact('perangkatDaerah', 'users'));
    }

    public function addUserForm()
    {
        $perangkatDaerah = PerangkatDaerah::all();
        return view('admin.add-user', compact('perangkatDaerah'));
    }

    public function store(Request $request)
    {
        Log::info('Data yang diterima:', ['data' => $request->all()]);
        Log::info('Route URL:', ['url' => route('admin.store')]);

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

        $user = new User();
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->perangkat_daerah_id = $validatedData['perangkat_daerah_id'];
        $user->save();

        return redirect()->route('admin.showUserTable')->with('success', 'Akun berhasil ditambahkan!');
    }

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