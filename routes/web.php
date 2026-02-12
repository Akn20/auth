<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SignInController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'dashboard.index')->name('dashboard');
// Login page
Route::view('/login', 'auth.login')->name('login');

// Forgot MPIN page
Route::view('/forgot-mpin', 'auth.forgot-mpin')->name('forgot.mpin');

// OTP verification page
Route::view('/otp', 'auth.otp')->name('otp');

// Set / Reset MPIN page (we’ll create UI later)
Route::view('/set-mpin', 'auth.set-mpin')->name('set.mpin');


                        /**------Apis--------**/
Route::post('/login', [SignInController::class, 'login'])->name('login.submit');
Route::post('/send-otp', [SignInController::class, 'sendOtp'])->name('forgot.mpin.submit');
Route::post('/resend-otp', [SignInController::class, 'resendOtp'])->name('otp.resend');
Route::post('/verify-otp', [SignInController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/set-mpin', [SignInController::class, 'setMpin'])->name('mpin.store');

                /**---------Authenticated Apis-----------  */
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

