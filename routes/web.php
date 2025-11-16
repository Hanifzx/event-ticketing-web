<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\Admin\UserManagementController;
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

require __DIR__.'/auth.php';
