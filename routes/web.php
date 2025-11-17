<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\OrganizerRegistrationController;
use App\Models\Event;
use App\Models\User;

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

// Grup Rute untuk Organizer
Route::middleware(['auth', 'organizer'])->group(function () {
    // Rute untuk halaman 'create'
    Route::view('/organizer/events/create', 'dashboard.organizer.create-event')
        ->name('organizer.events.create');

    // Rute untuk halaman 'edit'
    Route::get('/organizer/events/{event}/edit', function (Event $event) {
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized Access');
        }
        return view('dashboard.organizer.edit-event', ['event' => $event]);
    })->name('organizer.events.edit');

    // Rute untuk halaman 'manajemen tiket'
    Route::get('/organizer/events/{event}/tickets', function (Event $event) {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }
        return view('dashboard.organizer.manage-tickets-page', ['event' => $event]);
    })->name('organizer.tickets.index');
});

// Group Rute untuk Atmin
// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
//     // Rute untuk menampilkan form create user
//     Route::view('/users/create', 'dashboard.admin.create-user')
//         ->name('users.create');

//     // Rute untuk menampilkan form edit user
//     Route::get('/users/{user}/edit', function (User $user) {
//         return view('dashboard.admin.edit-user', ['user' => $user]);
//     })->name('users.edit');
// });

require __DIR__.'/auth.php';
