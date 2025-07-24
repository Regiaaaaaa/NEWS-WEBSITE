<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\KomentarController;
use App\Models\Kategori;    
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;

// 🌐 Halaman awal (welcome)
Route::get('/', function () {
    return view('welcome');
});

// 🔒 Dashboard controller (menampilkan berita terbaru)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 🔒 Semua route yang memerlukan login
Route::middleware('auth')->group(function () {

    // 🧑‍💼 Profile (default dari Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📰 CRUD Berita (hanya untuk berita milik user sendiri)
    Route::resource('berita', BeritaController::class)->except(['show']);
    Route::resource('kategori', KategoriController::class);

    // 👁️‍🗨️ Route detail berita (semua user bisa lihat)
    Route::get('/dashboard/berita/{berita}', [BeritaController::class, 'show'])
        ->name('dashboard.berita.show');

    // ❤️ Route Like & Unlike Berita
    Route::post('/berita/{berita}/like', [LikeController::class, 'toggle'])
        ->name('berita.like');

    // 💬 Route Komentar Berita
    Route::post('/berita/{berita}/komentar', [KomentarController::class, 'store'])
        ->name('berita.komentar.store');
});

require __DIR__.'/auth.php';
