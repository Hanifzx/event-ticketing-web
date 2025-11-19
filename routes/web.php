<?php

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\Auth\OrganizerRegistrationController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/events/explore', function () {
    return view('events.explore'); 
})->name('events.explore');

Route::get('/event/{event}', function (Event $event) {
    return view('events.show', ['event' => $event]); 
})->name('event.show');

// Organizer Registration
Route::get('/register-organizer', [OrganizerRegistrationController::class, 'create'])
        ->name('organizer.register');
Route::post('/register-organizer', [OrganizerRegistrationController::class, 'store']);

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/

// Pintu Masuk Utama (Redirect Logic)
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

/*
|--------------------------------------------------------------------------
| ORGANIZER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'organizer'])->prefix('organizer')->name('organizer.')->group(function () {
    
    // Halaman Status (Isolated Pages)
    Route::get('/pending', [OrganizerController::class, 'pending'])->name('pending');
    Route::get('/rejected', [OrganizerController::class, 'rejected'])->name('rejected');

    // Halaman Utama (Hanya bisa diakses jika Approved karena dijaga Middleware)
    Route::get('/dashboard', [OrganizerController::class, 'dashboard'])->name('dashboard');
    
    // Event Management
    Route::get('/events/create', [OrganizerController::class, 'createEvent'])->name('events.create');
    Route::get('/events/{event}/edit', [OrganizerController::class, 'editEvent'])->name('events.edit');
    Route::get('/events/{event}/tickets', [OrganizerController::class, 'manageTickets'])->name('tickets.index');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/events', [AdminController::class, 'events'])->name('events.index');
});

require __DIR__.'/auth.php';