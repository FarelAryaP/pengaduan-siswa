
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/dashboard/admin', function () {
    if (!Auth::check() || Auth::user()->role !== 'admin') {
        return redirect()->route('login');
    }
    return view('dashboard', ['role' => 'admin']);
})->name('dashboard.admin');

Route::get('/dashboard/user', function () {
    if (!Auth::check() || Auth::user()->role !== 'user') {
        return redirect()->route('login');
    }
    return view('dashboard', ['role' => 'user']);
})->name('dashboard.user');
