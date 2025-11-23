<?php

namespace App\Livewire\User\Events;

use Livewire\Component;
use App\Models\Ticket;
use App\Services\Event\BookingService;
use Illuminate\Support\Facades\Auth;

class BookTicket extends Component
{
    public Ticket $ticket;
    public $quantity = 1;
    public $maxLimit;

    // Lifecycle Hook: Dijalankan saat komponen dimuat
    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;

        $organizerLimit = $this->ticket->max_purchase_per_user > 0 
            ? $this->ticket->max_purchase_per_user 
            : 999;
        
        $this->maxLimit = min($organizerLimit, $this->ticket->quota);
    }

    // Action: Saat tombol "Pesan Sekarang" ditekan
    public function book(BookingService $bookingService)
    {
        // 1. Validasi Input Dasar
        $this->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $this->maxLimit],
        ]);

        // Cek Login
        if (!Auth::check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        // 2. Panggil Service untuk Logika Berat
        try {
            $booking = $bookingService->createBooking(
                Auth::user(),
                $this->ticket,
                $this->quantity
            );

            // 3. Feedback Sukses & Redirect
            session()->flash('message', 'Tiket berhasil dipesan!');

            return $this->redirect(route('user.bookings.show', $booking->id), navigate: true);

        } catch (\Exception $e) {
            // Handle error jika kuota tiba-tiba habis saat transaksi
            $this->addError('quantity', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.user.events.book-ticket');
    }
}