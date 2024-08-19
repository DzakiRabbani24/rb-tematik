<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PelaksanaController;
use App\Http\Controllers\KertasKerjaRenaksiController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\KepmenController;

// Alias middleware secara manual
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

    // Rute untuk profil pengguna
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

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
        Route::get('/kepmen', [KepmenController::class, 'showKepmen'])->name('kepmen.index');
        Route::get('/admin/kepmen/active', [KepmenController::class, 'showActiveKepmen'])->name('admin.kepmen.active');


        // Urusan tabel kepmen
        Route::get('/admin/kepmen', [KepmenController::class, 'index'])->name('admin.kepmen');

        // Edit nama OPD
        Route::put('/admin/users/{user}', [AdminController::class, 'editOPD'])->name('admin.user.update');

        // Delete kepmen
        Route::delete('/kepmen/delete', [KepmenController::class, 'delete'])->name('admin.delete.kepmen');

        // Aktivasi kepmen
        Route::post('/admin/kepmen/activate', [KepmenController::class, 'activateKepmen'])->name('admin.activate.kepmen');

        // Show Active Kepmen
        Route::get('/admin/kepmen/active', [KepmenController::class, 'showActiveKepmen'])->name('admin.kepmen.active');


        // Import kepmen
        Route::post('/import-kepmen', [KepmenController::class, 'importKepmen'])->name('admin.import.kepmen');

        // View Crosscutting dan Progress RB Tematik
        Route::get('/admin/crosscutting', [AdminController::class, 'viewCrosscutting'])->name('admin.crosscutting');
        Route::get('/admin/rbtematik', [AdminController::class, 'viewRBTematik'])->name('admin.rbtematik');
        Route::get('/rb-tematik-progress', [AdminController::class, 'getRbTematikProgress'])->name('admin.rbtematik.progress');
        Route::get('/available-years', [AdminController::class, 'getAvailableYears'])->name('admin.available.years');

        // Update Profile
        Route::put('/admin/update-profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
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

        // Update Profile
        Route::put('/koordinator/update-profile', [KoordinatorController::class, 'updateProfile'])->name('koordinator.updateProfile');
    });

    // Rute khusus pelaksana
    Route::middleware('role:pelaksana')->group(function () {
        Route::get('/pelaksana/dashboard', function () {
            return view('pelaksana.dashboard');
        })->name('pelaksana.dashboard');

        // Rute khusus pelaksana lainnya
        Route::get('/rencana-aksi-rb-tematik', [PelaksanaController::class, 'rencanaAksi'])->name('pelaksana.rencanaAksi');

        // Update Profile
        Route::put('/pelaksana/update-profile', [PelaksanaController::class, 'updateProfile'])->name('pelaksana.updateProfile');
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
