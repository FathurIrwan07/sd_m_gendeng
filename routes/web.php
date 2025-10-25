<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KontenHomeController;
use App\Http\Controllers\KategoriKegiatanController;
use App\Http\Controllers\KegiatanController;
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

     Route::resource('admin/konten-home', KontenHomeController::class)->names([
        'index' => 'konten-home.index',
        'create' => 'konten-home.create',
        'store' => 'konten-home.store',
        'show' => 'konten-home.show',
        'edit' => 'konten-home.edit',
        'update' => 'konten-home.update',
        'destroy' => 'konten-home.destroy',
    ]);

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
    
    // Route tambahan untuk hapus foto
    Route::delete('admin/konten-home/{kontenHome}/delete-photo', [KontenHomeController::class, 'deletePhoto'])
        ->name('konten-home.delete-photo');
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
