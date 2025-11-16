<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Auth\OrganizerRegistrationController;

Route::view('/', 'welcome');

// Menampilkan halaman form registrasi organizer
Route::get('/register-organizer', [OrganizerRegistrationController::class, 'create'])
        ->middleware('guest')
        ->name('organizer.register');

// Proses registrasi organizer
Route::post('/register-organizer', [OrganizerRegistrationController::class, 'store'])
        ->middleware('guest');

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserManagementController::class, 'index'])
        ->name('admin.users.index');

    // Route untuk Approve
    Route::patch('/admin/users/{user}/approve', [UserManagementController::class, 'approve'])
        ->name('admin.users.approve');

    // Route untuk Reject
    Route::patch('/admin/users/{user}/reject', [UserManagementController::class, 'reject'])
        ->name('admin.users.reject');
});

require __DIR__.'/auth.php';
