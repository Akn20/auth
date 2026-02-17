<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FinancialYearController;
use App\Http\Controllers\Admin\FinancialYearMappingController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;


// Login page
Route::view('/', 'auth.login')->name('login');

// Forgot MPIN page
Route::view('/forgot-mpin', 'auth.forgot-mpin')->name('forgot.mpin');

// Set MPIN page
Route::view('/set-mpin', 'auth.set-mpin')->name('set.mpin');
Route::view('/otp', 'auth.otp')->name('otp');

/**------Apis--------**/
Route::post('/login', [SignInController::class, 'login'])->name('login.submit');
Route::post('/send-otp', [SignInController::class, 'sendOtp'])->name('forgot.mpin.submit');
Route::post('/resend-otp', [SignInController::class, 'resendOtp'])->name('otp.resend');
Route::post('/verify-otp', [SignInController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/set-mpin', [SignInController::class, 'setMpin'])->name('mpin.store');

/**---------Authenticated Apis-----------  */
Route::middleware(['auth', 'admin'])->group(function () {

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('users', UserController::class)->except(['show']);

        // Dashboard
        Route::view('dashboard', 'admin.dashboard.index')->name('dashboard');

        // Financial Years
        Route::get('financial-years', [FinancialYearController::class, 'index'])
            ->name('financial-years.index');
        Route::get('financial-years/create', [FinancialYearController::class, 'create'])
            ->name('financial-years.create');
        Route::post('financial-years', [FinancialYearController::class, 'store'])
            ->name('financial-years.store');

        // FY-Mapping
        Route::get('financial-years/mapping', [FinancialYearMappingController::class, 'index'])
            ->name('financial-years.mapping');
        Route::post('financial-years/mapping', [FinancialYearMappingController::class, 'store'])
            ->name('financial-years.mapping.store');

        // User Management
        Route::get('users/deleted', [UserController::class, 'displayDeletedUser'])->name('users.deleted');
        Route::put('users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
        Route::delete('users/force-delete/{id}', [UserController::class, 'forceDeleteUser'])->name('users.forceDelete');

        // Role Management
        Route::get('roles/deleted', [RoleController::class, 'DisplayDeletedRoles'])->name('roles.deleted');
        Route::put('roles/restore/{id}', [RoleController::class, 'restore'])->name('roles.restore');
        Route::delete('roles/force-delete/{id}', [RoleController::class, 'forceDeleteRole'])->name('roles.forceDelete');
    });


    // Logout
    Route::post('/logout', [SignInController::class, 'logout'])->name('logout');
});
