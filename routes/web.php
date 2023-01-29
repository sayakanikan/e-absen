<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WaliController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WaliKelasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate']);

    // Forget Password
    Route::get('/forgotpassword', [AuthController::class, 'forgot'])->name('password.request');
    Route::post('/sendemail', [AuthController::class, 'sendEmail'])->name('password.email');
    Route::get('/resetpassword/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/updatepassword', [AuthController::class, 'updatePassword'])->name('password.update');

    // Dashboard Orang Tua Murid
    Route::get('/', [WaliController::class, 'index']);
    Route::get('/wali', [WaliController::class, 'wali']);
    Route::post('/wali', [WaliController::class, 'search']);
});

Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Ruang Kelas
    Route::get('/ruang', [KelasController::class, 'index']);
    
    // Wali Kelas
    Route::get('/walikelas', [WaliKelasController::class, 'index']);

    //Siswa
    Route::get('/siswa', [SiswaController::class, 'index']);

    //Update Profile
    Route::get('/akun', [DashboardController::class, 'edit']);
    Route::put('/akun/{id}', [DashboardController::class, 'update']);
});

Route::fallback(function () {
    return view('404');
});