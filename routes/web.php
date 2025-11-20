<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KontenHomeController;
use App\Http\Controllers\KategoriKegiatanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\InfoPpdbController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\TenagaPendidikController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanPengaduanController;
use App\Http\Controllers\UserPengaduanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatPengaduanController;
use App\Http\Controllers\PpdbPublicController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ============================================
// HOME / LANDING PAGE
// ============================================
Route::get('/', function () {
    if (Auth::check()) {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
    return view('home');
})->name('home');

// Tentang Kami
Route::get('/tentang', [KontenHomeController::class, 'publicIndex'])->name('about');

// Program & Kegiatan
Route::get('/program', [KegiatanController::class, 'publicIndex'])->name('programs');

// Prestasi
Route::get('/prestasi', [PrestasiController::class, 'publicIndex'])->name('achievements');

// Fasilitas
Route::get('/fasilitas', [FasilitasController::class, 'publicIndex'])->name('facilities');

// Tenaga Pendidik
Route::get('/guru', [TenagaPendidikController::class, 'publicIndex'])->name('teachers');

// Info PPDB
Route::get('/ppdb', [App\Http\Controllers\PpdbPublicController::class, 'index'])->name('ppdb');
// ============================================
// PENGADUAN PUBLIK (TANPA AUTH)
// ============================================

// Pengaduan Publik - Lihat daftar pengaduan
Route::get('/pengaduan/public', [UserPengaduanController::class, 'publicIndex'])
    ->name('pengaduan.public.index');

// Pengaduan Anonim - Form & Store
Route::get('/pengaduan/anonim/create', [UserPengaduanController::class, 'createAnonim'])
    ->name('pengaduan.anonim.create');
Route::post('/pengaduan/anonim', [UserPengaduanController::class, 'storeAnonim'])
    ->name('pengaduan.anonim.store');

// ============================================
// ADMIN ROUTES - PREFIX: /admin
// ============================================
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ========== USERS MANAGEMENT ==========
    Route::resource('users', UserController::class)->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'show' => 'users.show',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
    ]);
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->name('users.reset-password');

    // ========== KONTEN HOME ==========
    Route::resource('konten-home', KontenHomeController::class)->names([
        'index' => 'konten-home.index',
        'create' => 'konten-home.create',
        'store' => 'konten-home.store',
        'show' => 'konten-home.show',
        'edit' => 'konten-home.edit',
        'update' => 'konten-home.update',
        'destroy' => 'konten-home.destroy',
    ]);
    Route::delete('konten-home/{kontenHome}/delete-photo', [KontenHomeController::class, 'deletePhoto'])
        ->name('konten-home.delete-photo');

    // ========== KATEGORI KEGIATAN ==========
    Route::resource('kategori-kegiatan', KategoriKegiatanController::class)->names([
        'index' => 'kategori-kegiatan.index',
        'create' => 'kategori-kegiatan.create',
        'store' => 'kategori-kegiatan.store',
        'show' => 'kategori-kegiatan.show',
        'edit' => 'kategori-kegiatan.edit',
        'update' => 'kategori-kegiatan.update',
        'destroy' => 'kategori-kegiatan.destroy',
    ]);

    // ========== PROGRAM KEGIATAN ==========
    Route::resource('kegiatan', KegiatanController::class)->names([
        'index' => 'kegiatan.index',
        'create' => 'kegiatan.create',
        'store' => 'kegiatan.store',
        'show' => 'kegiatan.show',
        'edit' => 'kegiatan.edit',
        'update' => 'kegiatan.update',
        'destroy' => 'kegiatan.destroy',
    ]);
    Route::delete('kegiatan/{id}/delete-photo', [KegiatanController::class, 'deletePhoto'])
        ->name('kegiatan.delete-photo');

    // ========== PRESTASI ==========
    Route::resource('prestasi', PrestasiController::class)->names([
        'index' => 'prestasi.index',
        'create' => 'prestasi.create',
        'store' => 'prestasi.store',
        'show' => 'prestasi.show',
        'edit' => 'prestasi.edit',
        'update' => 'prestasi.update',
        'destroy' => 'prestasi.destroy',
    ]);
    Route::delete('prestasi/{id}/delete-photo', [PrestasiController::class, 'deletePhoto'])
        ->name('prestasi.delete-photo');

    // ========== INFO PPDB ==========
    Route::resource('info-ppdb', InfoPpdbController::class)->names([
        'index' => 'info-ppdb.index',
        'create' => 'info-ppdb.create',
        'store' => 'info-ppdb.store',
        'show' => 'info-ppdb.show',
        'edit' => 'info-ppdb.edit',
        'update' => 'info-ppdb.update',
        'destroy' => 'info-ppdb.destroy',
    ]);
    Route::delete('info-ppdb/{id}/delete-brosur', [InfoPpdbController::class, 'deleteBrosur'])
        ->name('info-ppdb.delete-brosur');

    // ========== FASILITAS ==========
    Route::resource('fasilitas', FasilitasController::class)->names([
        'index' => 'fasilitas.index',
        'create' => 'fasilitas.create',
        'store' => 'fasilitas.store',
        'show' => 'fasilitas.show',
        'edit' => 'fasilitas.edit',
        'update' => 'fasilitas.update',
        'destroy' => 'fasilitas.destroy',
    ]);
    Route::delete('fasilitas/{id}/delete-gambar', [FasilitasController::class, 'deleteGambar'])
        ->name('fasilitas.delete-gambar');

    // ========== TENAGA PENDIDIK ==========
    Route::resource('tenaga-pendidik', TenagaPendidikController::class)->names([
        'index' => 'tenaga-pendidik.index',
        'create' => 'tenaga-pendidik.create',
        'store' => 'tenaga-pendidik.store',
        'show' => 'tenaga-pendidik.show',
        'edit' => 'tenaga-pendidik.edit',
        'update' => 'tenaga-pendidik.update',
        'destroy' => 'tenaga-pendidik.destroy',
    ]);
    Route::delete('tenaga-pendidik/{id}/delete-foto', [TenagaPendidikController::class, 'deleteFoto'])
        ->name('tenaga-pendidik.delete-foto');

    // ========== KATEGORI PENGADUAN ==========
    Route::resource('kategori-pengaduan', KategoriPengaduanController::class)->names([
        'index' => 'kategori-pengaduan.index',
        'create' => 'kategori-pengaduan.create',
        'store' => 'kategori-pengaduan.store',
        'show' => 'kategori-pengaduan.show',
        'edit' => 'kategori-pengaduan.edit',
        'update' => 'kategori-pengaduan.update',
        'destroy' => 'kategori-pengaduan.destroy',
    ]);

    // ========== PENGADUAN (ADMIN) ==========
    Route::resource('pengaduan', PengaduanController::class)->names([
        'index' => 'pengaduan.index',
        'show' => 'pengaduan.show',
        'edit' => 'pengaduan.edit',
        'update' => 'pengaduan.update',
        'destroy' => 'pengaduan.destroy',
    ]);
    Route::patch('pengaduan/{pengaduan}/update-status', [PengaduanController::class, 'updateStatus'])
        ->name('pengaduan.updateStatus');

    // ========== TANGGAPAN PENGADUAN ==========
    Route::resource('tanggapan', TanggapanPengaduanController::class)->names([
        'index' => 'tanggapan.index',
        'create' => 'tanggapan.create',
        'store' => 'tanggapan.store',
        'show' => 'tanggapan.show',
        'edit' => 'tanggapan.edit',
        'update' => 'tanggapan.update',
        'destroy' => 'tanggapan.destroy',
    ]);

    // ========== CHAT PENGADUAN (ADMIN) ==========
    Route::get('chat', [ChatPengaduanController::class, 'index'])->name('chat.index');
    Route::get('chat/{pengaduan}', [ChatPengaduanController::class, 'show'])->name('chat.show');
    Route::post('chat/{pengaduan}', [ChatPengaduanController::class, 'store'])->name('chat.store');
    Route::get('chat/{pengaduan}/new-messages', [ChatPengaduanController::class, 'getNewMessages'])
        ->name('chat.get-new-messages');

    // ========== EXPORT PDF ==========
    Route::get('pengaduan-export/pdf-gabungan', [TanggapanPengaduanController::class, 'exportPdfGabungan'])
        ->name('pengaduan.export-pdf-gabungan');
});

// ============================================
// USER ROUTES - PREFIX: /user
// ============================================
Route::middleware(['auth', 'role:User'])->prefix('user')->group(function () {

    // Dashboard User
    Route::get('/dashboard', [UserPengaduanController::class, 'dashboard'])
        ->name('user.dashboard');

    // ========== PENGADUAN (USER) ==========
    Route::get('/pengaduan', [UserPengaduanController::class, 'index'])
        ->name('user.pengaduan.index');
    Route::get('/pengaduan/create', [UserPengaduanController::class, 'create'])
        ->name('user.pengaduan.create');
    Route::post('/pengaduan', [UserPengaduanController::class, 'store'])
        ->name('user.pengaduan.store');
    Route::get('/pengaduan/{pengaduan}', [UserPengaduanController::class, 'show'])
        ->name('user.pengaduan.show');

    // ========== CHAT PENGADUAN (USER) ==========
    Route::get('chat', [ChatPengaduanController::class, 'userIndex'])
        ->name('user.chat.index');
    Route::get('chat/{pengaduan}', [ChatPengaduanController::class, 'userChat'])
        ->name('user.chat.show');
    Route::post('chat/{pengaduan}', [ChatPengaduanController::class, 'userStore'])
        ->name('user.chat.store');
    Route::get('chat/{pengaduan}/new-messages', [ChatPengaduanController::class, 'userGetNewMessages'])
        ->name('user.chat.get-new-messages');
});

// ============================================
// PROFILE ROUTES (UNTUK SEMUA USER)
// ============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================
// AUTH ROUTES
// ============================================
require __DIR__ . '/auth.php';