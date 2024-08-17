<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PerangkatDaerah;
use App\Models\KertasKerjaRenaksi;
use Illuminate\Support\Facades\Auth;

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

    //delete user
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
        // Tentukan aturan validasi dasar
        $rules = [
            'username' => 'required|string|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#.,]).+$/'
            ],
            'role' => 'required|string|in:koordinator,pelaksana,admin', // Tambahkan admin sebagai opsi role
        ];

        // Tambahkan validasi perangkat daerah jika role bukan admin
        if ($request->role !== 'admin') {
            $rules['perangkat_daerah_id'] = 'required|exists:perangkat_daerah,id';
        }

        // Validasi data request
        $validatedData = $request->validate($rules, [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki panjang minimal :min karakter.',
            'password.regex' => 'Password harus mengandung huruf, angka, dan simbol.',
            'password.comfirmed' => 'Password tidak sesuai',
        ]);

        // Buat user baru
        $user = new User();
        $user->username = $validatedData['username'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];

        // Jika role bukan admin, simpan perangkat daerah
        if ($validatedData['role'] !== 'admin') {
            $user->perangkat_daerah_id = $validatedData['perangkat_daerah_id'];
        }

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
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&#.,]).+$/'
            ],
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus memiliki panjang minimal :min karakter.',
            'password.regex' => 'Password harus mengandung huruf, angka, dan simbol.',
            'password.comfirmed' => 'Password tidak sesuai',
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

    //edit OPD pada page add-user
    public function editOPD(Request $request, User $user)
    {
        $validated = $request->validate([
            'perangkat_daerah_id' => 'required|exists:perangkat_daerah,id',
        ]);

        $user->perangkat_daerah_id = $validated['perangkat_daerah_id'];
        $user->save();

        return redirect()->back()->with('success', 'Perangkat Daerah berhasil diperbarui.');
    }

}
