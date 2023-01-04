<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate']);

    // Forget Password
    Route::get('/forgotpassword', [AuthController::class, 'forgot'])->name('password.request');
    Route::post('/sendemail', [AuthController::class, 'sendEmail'])->name('password.email');
    Route::get('/resetpassword/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/updatepassword', [AuthController::class, 'updatePassword'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
});

Route::fallback(function () {
    return view('404');
});