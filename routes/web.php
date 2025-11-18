<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\OrganizerRegistrationController;
use App\Models\Event;

Route::view('/', 'welcome');

// Organizer Registration
Route::get('/register-organizer', [OrganizerRegistrationController::class, 'create'])
        ->middleware('guest')
        ->name('organizer.register');
Route::post('/register-organizer', [OrganizerRegistrationController::class, 'store'])
        ->middleware('guest');

// DASHBOARD
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// === GRUP RUTE ORGANIZER ===
Route::middleware(['auth', 'organizer'])->group(function () {
    // Create Event
    Route::view('/organizer/events/create', 'organizer.events.create')
        ->name('organizer.events.create');

    // Edit Event
    Route::get('/organizer/events/{event}/edit', function (Event $event) {
        if ($event->user_id !== Auth::id()) abort(403);
        return view('organizer.events.edit', ['event' => $event]);
    })->name('organizer.events.edit');

    // Manage Tickets
    Route::get('/organizer/events/{event}/tickets', function (Event $event) {
        if ($event->user_id !== Auth::id()) abort(403);
        return view('organizer.events.tickets', ['event' => $event]);
    })->name('organizer.tickets.index');
});

// === GRUP RUTE ADMIN ===
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Manage Users
    Route::view('/users', 'admin.users')
        ->name('users.index');
    
    // Manage Events
    Route::view('/events', 'admin.events')
        ->name('events.index');
});

Route::get('/event/{event}', function (Event $event) {
    return view('events.show', ['event' => $event]); 
})->name('event.show');

require __DIR__.'/auth.php';