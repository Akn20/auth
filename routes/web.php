<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SignInController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;

Route::view('/', 'dashboard.index')->name('dashboard');
// Login page
Route::view('/login', 'auth.login')->name('login');

// Forgot MPIN page
Route::view('/forgot-mpin', 'auth.forgot-mpin')->name('forgot.mpin');

// OTP verification page
Route::view('/otp', 'auth.otp')->name('otp');

// Set / Reset MPIN page (we’ll create UI later)
Route::view('/set-mpin', 'auth.set-mpin')->name('set.mpin');

Route::post('/login', [SignInController::class, 'login'])->name('login.submit');
Route::post('/send-otp', [SignInController::class, 'sendOtp'])->name('forgot.mpin.submit');
Route::post('/verify-otp', [SignInController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/set-mpin', [SignInController::class, 'setMpin'])->name('mpin.store');

Route::middleware('auth')->group(function () {

    // Users (Admin only)
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // Roles (Admin only)    
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/role', [RoleController::class, 'store']);
    Route::post('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
    
    // Logout
    Route::post('/logout', [SignInController::class, 'logout']);
});


// Login submit
// Route::post('/login', [AuthController::class, 'login'])
//     ->name('login.submit');

// // Send OTP (from Forgot MPIN)
// Route::post('/forgot-mpin', [AuthController::class, 'sendOtp'])
//     ->name('forgot.mpin.submit');

// // Verify OTP
// Route::post('/otp', [AuthController::class, 'verifyOtp'])
//     ->name('otp.verify');

// // Resend OTP
// Route::post('/resend-otp', [AuthController::class, 'resendOtp'])
//     ->name('otp.resend');

// // Save MPIN
// Route::post('/set-mpin', [AuthController::class, 'storeMpin'])
//     ->name('mpin.store');
// Route::view('/', 'dashboard.index')
//     ->name('dashboard');

// Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
// Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('otp.send');
// Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
// Route::post('/resend-otp', [OtpController::class, 'resendOtp'])->name('otp.resend');

// Route::get('/otp', [OtpController::class, 'showOtpForm'])
//     ->name('otp.form');
