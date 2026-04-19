<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\DashboardController    as UserDashboardController;
use App\Http\Controllers\User\PengaduanController    as UserPengaduanController;
use App\Http\Controllers\User\PesanController        as UserPesanController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PengaduanController as PetugasPengaduanController;
use App\Http\Controllers\Petugas\PesanController     as PetugasPesanController;

// ============================================
// ROOT — Redirect berdasarkan status login
// ============================================
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'petugas'
            ? redirect()->route('petugas.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});

// ============================================
// AUTH ROUTES (Guest only)
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login',     [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login',    [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register',  [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ============================================
// USER ROUTES  (role: user)
// ============================================
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Pengaduan
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
            Route::get('/',        [UserPengaduanController::class, 'index'])  ->name('index');
            Route::get('/create',  [UserPengaduanController::class, 'create']) ->name('create');
            Route::post('/',       [UserPengaduanController::class, 'store'])  ->name('store');
            Route::get('/{id}',    [UserPengaduanController::class, 'show'])   ->name('show');
            Route::delete('/{id}', [UserPengaduanController::class, 'destroy'])->name('destroy');
        });

        // Pesan (balasan user ke petugas) — BARU
        Route::prefix('pengaduan/{pengaduanId}/pesan')->name('pesan.')->group(function () {
            Route::post('/',          [UserPesanController::class, 'store'])   ->name('store');
            Route::post('/mark-read', [UserPesanController::class, 'markRead'])->name('markRead');
        });
    });

// ============================================
// PETUGAS ROUTES  (role: petugas)
// ============================================
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');

        // Pengaduan Management
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
            Route::get('/',                [PetugasPengaduanController::class, 'index'])       ->name('index');
            Route::get('/{id}',            [PetugasPengaduanController::class, 'show'])        ->name('show');
            Route::patch('/{id}/status',   [PetugasPengaduanController::class, 'updateStatus'])->name('updateStatus');
            Route::delete('/{id}',         [PetugasPengaduanController::class, 'destroy'])     ->name('destroy');
        });

        // Pesan (petugas kirim/hapus pesan ke user) — BARU
        Route::prefix('pengaduan/{pengaduanId}/pesan')->name('pesan.')->group(function () {
            Route::post('/',     [PetugasPesanController::class, 'store'])  ->name('store');
            Route::delete('/{id}', [PetugasPesanController::class, 'destroy'])->name('destroy');
        });
    });

// ============================================
// LEGACY REDIRECTS
// ============================================
Route::get('/dashboard/user',    fn () => redirect()->route('user.dashboard'));
Route::get('/dashboard/petugas', fn () => redirect()->route('petugas.dashboard'));