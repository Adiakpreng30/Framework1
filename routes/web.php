<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\HomeController;

//halaman guest
Route::middleware('guest')->group(function () {
    // Halaman Form Login
    Route::get('/auth', [AuthController::class, 'index'])->name('login');

    // Proses Submit Login
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login.process');

    // Halaman Depan
    Route::get('/', function () {
        return view('welcome');
    });
});

//halaman wajib login
Route::middleware('auth')->group(function () {

    // Logout (Bisa diakses semua user yang login)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- DASHBOARD UNTUK USER BIASA ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Fitur User Biasa (Contoh: Kirim Pertanyaan)
    Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/home', [HomeController::class, 'index']);

    //Khusus admin
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('pelanggan', PelangganController::class);
    });
});
