<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KontenHomeController;
use App\Http\Controllers\KategoriKegiatanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\InfoPpdbController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\TenagaPendidikController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }

    return view('home');
});

// Admin Dashboard - Dilindungi oleh middleware 'auth' dan 'role:Admin'
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Konten Home Routes
    Route::resource('admin/konten-home', KontenHomeController::class)->names([
        'index' => 'konten-home.index',
        'create' => 'konten-home.create',
        'store' => 'konten-home.store',
        'show' => 'konten-home.show',
        'edit' => 'konten-home.edit',
        'update' => 'konten-home.update',
        'destroy' => 'konten-home.destroy',
    ]);

    // Kategori Kegiatan Routes
    Route::resource('admin/kategori-kegiatan', KategoriKegiatanController::class)->names([
        'index' => 'kategori-kegiatan.index',
        'create' => 'kategori-kegiatan.create',
        'store' => 'kategori-kegiatan.store',
        'show' => 'kategori-kegiatan.show',
        'edit' => 'kategori-kegiatan.edit',
        'update' => 'kategori-kegiatan.update',
        'destroy' => 'kategori-kegiatan.destroy',
    ]);
    
    // Program Kegiatan Routes
    Route::resource('admin/kegiatan', KegiatanController::class)->names([
        'index' => 'kegiatan.index',
        'create' => 'kegiatan.create',
        'store' => 'kegiatan.store',
        'show' => 'kegiatan.show',
        'edit' => 'kegiatan.edit',
        'update' => 'kegiatan.update',
        'destroy' => 'kegiatan.destroy',
    ]);

    // Prestasi Routes
    Route::resource('admin/prestasi', PrestasiController::class)->names([
        'index' => 'prestasi.index',
        'create' => 'prestasi.create',
        'store' => 'prestasi.store',
        'show' => 'prestasi.show',
        'edit' => 'prestasi.edit',
        'update' => 'prestasi.update',
        'destroy' => 'prestasi.destroy',
    ]);
    
    // Info PPDB Routes
    Route::resource('admin/info-ppdb', InfoPpdbController::class)->names([
        'index' => 'info-ppdb.index',
        'create' => 'info-ppdb.create',
        'store' => 'info-ppdb.store',
        'show' => 'info-ppdb.show',
        'edit' => 'info-ppdb.edit',
        'update' => 'info-ppdb.update',
        'destroy' => 'info-ppdb.destroy',
    ]);

    // Fasilitas Routes
    Route::resource('admin/fasilitas', FasilitasController::class)->names([
        'index' => 'fasilitas.index',
        'create' => 'fasilitas.create',
        'store' => 'fasilitas.store',
        'show' => 'fasilitas.show',
        'edit' => 'fasilitas.edit',
        'update' => 'fasilitas.update',
        'destroy' => 'fasilitas.destroy',
    ]);

    // Tenaga Pendidik Routes
    Route::resource('admin/tenaga-pendidik', TenagaPendidikController::class)->names([
        'index' => 'tenaga-pendidik.index',
        'create' => 'tenaga-pendidik.create',
        'store' => 'tenaga-pendidik.store',
        'show' => 'tenaga-pendidik.show',
        'edit' => 'tenaga-pendidik.edit',
        'update' => 'tenaga-pendidik.update',
        'destroy' => 'tenaga-pendidik.destroy',
    ]);
    
    // Route tambahan untuk hapus foto
    Route::delete('admin/konten-home/{kontenHome}/delete-photo', [KontenHomeController::class, 'deletePhoto'])
        ->name('konten-home.delete-photo');
    Route::delete('admin/kegiatan/{id}/delete-photo', [KegiatanController::class, 'deletePhoto'])
        ->name('kegiatan.delete-photo');
    Route::delete('admin/info-ppdb/{id}/delete-brosur', [InfoPpdbController::class, 'deleteBrosur'])
        ->name('info-ppdb.delete-brosur');
    Route::delete('admin/prestasi/{id}/delete-photo', [PrestasiController::class, 'deletePhoto'])
        ->name('prestasi.delete-photo');
    Route::delete('admin/fasilitas/{id}/delete-gambar', [FasilitasController::class, 'deleteGambar'])
        ->name('fasilitas.delete-gambar');
    Route::delete('admin/tenaga-pendidik/{id}/delete-foto', [TenagaPendidikController::class, 'deleteFoto'])
        ->name('tenaga-pendidik.delete-foto');
});

// User Dashboard - Dilindungi oleh middleware 'auth' dan 'role:User'
Route::middleware(['auth', 'role:User'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';