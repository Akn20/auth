<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| All admin pages (dashboard, users, roles) live under the /admin prefix
| and share the "admin." route name prefix.
*/
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |------------------------------------------------------------------
        | Admin Dashboard
        |------------------------------------------------------------------
        */
        Route::get('dashboard', function () {
            return view('admin.dashboard.index', [
                'title' => 'Admin Dashboard',
            ]);
        })->name('dashboard');

        /*
        |------------------------------------------------------------------
        | User soft-delete routes
        |------------------------------------------------------------------
        | These handle the "Deleted Users" list and restoring soft-deleted
        | users. They must come before the resource routes.
        */
        Route::get('users/deleted', [UserController::class, 'deleted'])
            ->name('users.deleted');

        Route::post('users/{id}/restore', [UserController::class, 'restore'])
            ->name('users.restore');

        /*
        |------------------------------------------------------------------
        | Role soft-delete routes
        |------------------------------------------------------------------
        | These handle the "Deleted Roles" list and restoring soft-deleted
        | roles.
        */
        Route::get('roles/deleted', [RoleController::class, 'deleted'])
            ->name('roles.deleted');

        Route::post('roles/{id}/restore', [RoleController::class, 'restore'])
            ->name('roles.restore');

        /*
        |------------------------------------------------------------------
        | Resource routes (CRUD)
        |------------------------------------------------------------------
        | Standard RESTful routes for users and roles. We exclude "show"
        | since you are using index/edit, not a separate show page.
        */
        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
    });

/*
|--------------------------------------------------------------------------
| Auth Views (Login & MPIN screens)
|--------------------------------------------------------------------------
| These routes just return views, no controller logic.
*/

// Login page
Route::view('/', 'auth.login')->name('login');

// Forgot MPIN page
Route::view('/forgot-mpin', 'auth.forgot-mpin')->name('forgot.mpin');

// Set MPIN page
Route::view('/set-mpin', 'auth.set-mpin')->name('set.mpin');

/*
|--------------------------------------------------------------------------
| Auth Actions (Login & MPIN submit handlers)
|--------------------------------------------------------------------------
| These routes handle form submissions for login and MPIN flows.
*/

// Handle login form submit
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Handle "forgot MPIN" form submit (send OTP)
Route::post('/forgot-mpin', [AuthController::class, 'sendOtp'])
    ->name('forgot.mpin.submit');

// Handle "set MPIN" form submit
Route::post('/set-mpin', [AuthController::class, 'storeMpin'])
    ->name('mpin.store');

/*
|--------------------------------------------------------------------------
| OTP Routes
|--------------------------------------------------------------------------
| Routes used during the OTP verification flow.
*/

// Show OTP input form
Route::get('/otp', [OtpController::class, 'showOtpForm'])
    ->name('otp.form');

// Send OTP to user (e.g. via SMS/email)
Route::post('/send-otp', [OtpController::class, 'sendOtp'])
    ->name('otp.send');

// Verify the submitted OTP
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])
    ->name('otp.verify');

// Resend OTP
Route::post('/resend-otp', [OtpController::class, 'resendOtp'])
    ->name('otp.resend');
