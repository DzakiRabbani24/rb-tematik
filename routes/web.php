<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PelaksanaController;
use App\Http\Controllers\KertasKerjaRenaksiController;
use App\Http\Controllers\KoordinatorController;

// Alias middleware secara manual (jika tidak ada kernel untuk mendaftarkannya)
Route::aliasMiddleware('role', RoleMiddleware::class);

// Rute untuk tampilan landing page
Route::get('/', function () {
    return view('landing-page');
});

// Rute untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute yang hanya bisa diakses oleh pengguna yang terautentikasi
Route::middleware('auth')->group(function () {

    // Rute dashboard umum yang mengarahkan berdasarkan role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        // Arahkan pengguna ke dashboard sesuai peran
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'koordinator':
                return redirect()->route('koordinator.dashboard');
            case 'pelaksana':
                return redirect()->route('pelaksana.dashboard');
            default:
                return redirect('/');
        }
    })->name('dashboard');

    // Rute khusus admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Tambah akun oleh admin
        Route::get('/admin/add-user', [AdminController::class, 'addUserForm'])->name('admin.addUserForm');
        Route::post('/admin/user/storeAdmin', [AdminController::class, 'storeAdmin'])->name('admin.user.storeAdmin');
        Route::post('/admin/add-user', [AdminController::class, 'store'])->name('admin.store');

        // Hapus Akun
        Route::delete('/admin/user/{id}', [AdminController::class, 'delete'])->name('admin.user.delete');

        // Menampilkan tabel kepmen
        Route::get('/kepmen', [AdminController::class, 'showKepmen'])->name('kepmen.index');

        // Import kepmen
        Route::post('/kepmen/import', [AdminController::class, 'importKepmen'])->name('kepmen.import');

        // View Crosscutting dan Progress RB Tematik
        Route::get('/admin/crosscutting', [AdminController::class, 'viewCrosscutting'])->name('admin.crosscutting');
        Route::get('/admin/rbtematik', [AdminController::class, 'viewRBTematik'])->name('admin.rbtematik');
        Route::get('/rb-tematik-progress', [AdminController::class, 'getRbTematikProgress'])->name('admin.rbtematik.progress');
        Route::get('/available-years', [AdminController::class, 'getAvailableYears'])->name('admin.available.years');
    });

    // Rute khusus koordinator
    Route::middleware('role:koordinator')->group(function () {
        Route::get('/koordinator/dashboard', function () {
            return view('koordinator.dashboard');
        })->name('koordinator.dashboard');
        
        // Rute khusus koordinator lainnya
        Route::get('/koordinator/evaluasi', [KoordinatorController::class, 'evaluasi'])->name('koordinator.evaluasi');
        Route::get('/koordinator/roadmap', [KoordinatorController::class, 'roadmap'])->name('koordinator.roadmap');
        Route::get('/koordinator/rencanaaksi', [KoordinatorController::class, 'rencanaaksi'])->name('koordinator.rencanaaksi');
    });

    // Rute khusus pelaksana
    Route::middleware('role:pelaksana')->group(function () {
        Route::get('/pelaksana/dashboard', function () {
            return view('pelaksana.dashboard');
        })->name('pelaksana.dashboard');

        // Rute khusus pelaksana lainnya
        Route::get('/rencana-aksi-rb-tematik', [PelaksanaController::class, 'rencanaAksi'])->name('pelaksana.rencanaAksi');
    });

    // Rute untuk input perangkat daerah hanya bisa diakses oleh admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/perangkat-daerah', [FormController::class, 'perangkatDaerahForm'])->name('admin.perangkat.daerah.form');
        Route::post('/perangkat-daerah', [FormController::class, 'submitPerangkatDaerah'])->name('perangkat.daerah.submit');
        Route::get('/perangkat-daerah/edit/{id}', [FormController::class, 'editPerangkatDaerah'])->name('perangkat.daerah.edit');
        Route::put('/perangkat-daerah/update', [FormController::class, 'updatePerangkatDaerah'])->name('perangkat.daerah.update');
        Route::delete('/perangkat-daerah/delete/{id}', [FormController::class, 'deletePerangkatDaerah'])->name('perangkat.daerah.delete');
    });
});

// Import dan Export Excel
Route::post('/import-kertas-kerja-renaksi', [KertasKerjaRenaksiController::class, 'import'])->name('kertasKerjaRenaksi.import');
Route::get('/export-kertas-kerja-renaksi', [KertasKerjaRenaksiController::class, 'export'])->name('kertasKerjaRenaksi.export');
