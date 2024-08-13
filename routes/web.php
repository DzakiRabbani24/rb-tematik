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

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'koordinator') {
            return redirect()->route('koordinator.dashboard');
        } elseif ($user->role === 'pelaksana') {
            return redirect()->route('pelaksana.dashboard');
        } else {
            return redirect('/');
        }
    })->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Tambah akun oleh admin
        Route::get('/admin/add-user', [AdminController::class, 'addUserForm'])->name('admin.addUserForm');
        Route::post('/admin/add-user', [AdminController::class, 'store'])->name('admin.store');

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
        
        // Tambahkan rute khusus koordinator lainnya di sini
        Route::get('/koordinator/evaluasi', [KoordinatorController::class, 'evaluasi'])->name('koordinator.evaluasi');
        Route::get('/koordinator/roadmap', [KoordinatorController::class, 'roadmap'])->name('koordinator.roadmap');
        Route::get('/koordinator/rencanaaksi', [KoordinatorController::class, 'rencanaaksi'])->name('koordinator.rencanaaksi');
    });

    // Rute khusus pelaksana
    Route::middleware('role:pelaksana')->group(function () {
        Route::get('/pelaksana/dashboard', function () {
            return view('pelaksana.dashboard');
        })->name('pelaksana.dashboard');

        // Tambahkan rute khusus pelaksana lainnya di sini
        Route::get('/rencana-aksi-rb-tematik', [PelaksanaController::class, 'rencanaAksi'])->name('pelaksana.rencanaAksi');
    });
});

// Rute untuk input perangkat daerah
Route::middleware('role:admin')->group(function () {
    Route::get('/perangkat-daerah', [FormController::class, 'perangkatDaerahForm'])->name('admin.perangkat.daerah.form');
    Route::post('/perangkat-daerah', [FormController::class, 'submitPerangkatDaerah'])->name('perangkat.daerah.submit');
    Route::get('/perangkat-daerah/edit/{id}', [FormController::class, 'editPerangkatDaerah'])->name('perangkat.daerah.edit');
    Route::post('/perangkat-daerah/update', [FormController::class, 'updatePerangkatDaerah'])->name('perangkat.daerah.update');
    Route::delete('/perangkat-daerah/delete/{id}', [FormController::class, 'deletePerangkatDaerah'])->name('perangkat.daerah.delete');
});

// Import Export Excel
Route::post('/import-kertas-kerja-renaksi', [KertasKerjaRenaksiController::class, 'import'])->name('kertasKerjaRenaksi.import');
Route::get('/export-kertas-kerja-renaksi', [KertasKerjaRenaksiController::class, 'export'])->name('kertasKerjaRenaksi.export');