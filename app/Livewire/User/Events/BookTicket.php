<?php

namespace App\Livewire\User\Events;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Booking; 
use App\Services\Event\BookingService;
use Illuminate\Support\Facades\Auth;

class BookTicket extends Component
{
    public Ticket $ticket;
    public $quantity = 1;
    public $maxLimit;
    public $isLimitReached = false;

    // Lifecycle Hook: Dijalankan saat komponen dimuat
    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;

        $globalQuota = $this->ticket->quota;
        $settingLimit = $this->ticket->max_purchase_per_user > 0 
            ? $this->ticket->max_purchase_per_user 
            : 9999; 
    
        if (Auth::check()) {
            $userBoughtCount = Booking::where('user_id', Auth::id())
                ->where('ticket_id', $this->ticket->id)
                ->whereIn('status', ['pending', 'approved'])
                ->sum('quantity');

            $remainingPersonalQuota = $settingLimit - $userBoughtCount;

            if ($remainingPersonalQuota <= 0) {
                $this->isLimitReached = true;
                $this->maxLimit = 0;
            } else {
                $this->maxLimit = min($remainingPersonalQuota, $globalQuota);
            }
        } else {
            $this->maxLimit = min($settingLimit, $globalQuota);
        }
    }

    // Action: Saat tombol "Pesan Sekarang" ditekan
    public function book(BookingService $bookingService)
    {
        // Cek Login
        if (!Auth::check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        if ($this->isLimitReached) {
            $this->addError('quantity', 'Batas pembelian tiket Anda telah tercapai.');
            return;
        }

        // 1. Validasi Input Dasar
        $this->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $this->maxLimit],
        ]);

        // 2. Panggil Service untuk Logika Berat
        try {
            $booking = $bookingService->createBooking(
                Auth::user(),
                $this->ticket,
                $this->quantity
            );

            // 3. Feedback Sukses & Redirect
            session()->flash('success', 'Tiket berhasil dipesan!');

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