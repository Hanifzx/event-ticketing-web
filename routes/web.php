<?php

use Illuminate\Support\Facades\Route;
use App\Models\Event;

// --- Import Controllers ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\OrganizerRegistrationController;

// Namespace Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\EventController as AdminEvent;

// Namespace Organizer
use App\Http\Controllers\Organizer\DashboardController as OrganizerDashboard;
use App\Http\Controllers\Organizer\EventController as OrganizerEvent;
use App\Http\Controllers\Organizer\TicketController as OrganizerTicket;
use App\Http\Controllers\Organizer\StatusController as OrganizerStatus;
use App\Http\Controllers\Organizer\BookingController as OrganizerBooking;

// Namespace User
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\BookTicketController as UserBookTicket;
use App\Http\Controllers\User\BookingController as UserBooking;
use App\Http\Controllers\User\FavoriteController as UserFavorite;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Akses Publik)
|--------------------------------------------------------------------------
*/

// Halaman Depan
Route::view('/', 'welcome')->name('home');

// Katalog Event (Menggunakan Livewire EventCatalog)
Route::view('/events/explore', 'events.explore')->name('events.explore');

// Detail Event (Menggunakan Livewire EventDetail)
Route::get('/event/{event}', function (Event $event) {
    return view('events.show', ['event' => $event]);
})->name('event.show');

// Registrasi Khusus Organizer
Route::middleware('guest')->group(function () {
    Route::get('/register-organizer', [OrganizerRegistrationController::class, 'create'])
        ->name('organizer.register');
    Route::post('/register-organizer', [OrganizerRegistrationController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Pintu Masuk Utama (Redirect Logic by Service)
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // 2. Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');

    /*
    |--------------------------------------------------------------------------
    | ADMIN DOMAIN
    |--------------------------------------------------------------------------
    | Prefix: /admin
    | Name: admin.*
    | Middleware: admin (Pastikan alias middleware sudah didaftarkan)
    */
    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
            Route::get('/users', [AdminUser::class, 'index'])->name('users.index');
            Route::get('/events', [AdminEvent::class, 'index'])->name('events.index');
        });

    /*
    |--------------------------------------------------------------------------
    | ORGANIZER DOMAIN
    |--------------------------------------------------------------------------
    | Prefix: /organizer
    | Name: organizer.*
    | Middleware: organizer
    */
    Route::middleware('organizer')
        ->prefix('organizer')
        ->name('organizer.')
        ->group(function () {
            
            // Status Pages (Pending / Rejected)
            Route::get('/pending', [OrganizerStatus::class, 'pending'])->name('pending');
            Route::get('/rejected', [OrganizerStatus::class, 'rejected'])->name('rejected');
            Route::get('/bookings', [OrganizerBooking::class, 'index'])->name('bookings.index');

            // Dashboard Utama
            Route::get('/dashboard', [OrganizerDashboard::class, 'index'])->name('dashboard');

            // Event Management Group
            Route::prefix('events')->name('events.')->group(function () {
                
                // CRUD Event
                Route::get('/create', [OrganizerEvent::class, 'create'])->name('create');
                Route::get('/{event}/edit', [OrganizerEvent::class, 'edit'])->name('edit');

                // Ticket Management (Nested Resource)
                Route::get('/{event}/tickets', [OrganizerTicket::class, 'index'])->name('tickets.index');
            });
        });

    /*
    |--------------------------------------------------------------------------
    | USER / CUSTOMER DOMAIN
    |--------------------------------------------------------------------------
    | Prefix: /user
    | Name: user.*
    */
    Route::prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/dashboard', [UserDashboard::class, 'index'])
                ->name('dashboard');
            // Tambahkan route booking history di sini nanti

            // Route Booking Tiket (Checkout Page)
            Route::get('/events/{event}/checkout', [UserBookTicket::class, 'create'])
                ->name('events.book.ticket');
                
            // Halaman List Riwayat Pesanan
            Route::get('/bookings', [UserBooking::class, 'index'])
                ->name('bookings.index');

            // Route Detail Booking Tiket
            Route::get('/bookings/{booking}', [UserBooking::class, 'show'])
                ->name('bookings.show');

            // Route Download PDF Tiket
            Route::get('/bookings/{booking}/download-ticket', [UserBooking::class, 'downloadTickets'])
                ->name('bookings.download');

            Route::get('/favorites', [UserFavorite::class, 'index'])
                ->name('favorites.index');

        });

});

require __DIR__.'/auth.php';