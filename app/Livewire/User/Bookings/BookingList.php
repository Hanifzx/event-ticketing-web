<?php

namespace App\Livewire\User\Bookings;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Services\Event\BookingService;
use Livewire\Component;

class BookingList extends Component
{
    public function cancelBooking($id, BookingService $bookingService)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (!$booking) {
            $this->dispatch('flash-message', type: 'error', message: 'Pesanan tidak ditemukan.');
            return;
        }

        try {
            $bookingService->cancelBooking($booking);

            // Kirim Notifikasi Sukses
            $this->dispatch('flash-message', 
                type: 'success', 
                message: 'Pesanan berhasil dibatalkan. Kuota tiket telah dikembalikan.'
            );

        } catch (\Exception $e) {
            // Tangkap Error dari Service
            $this->dispatch('flash-message', 
                type: 'error', 
                message: $e->getMessage()
            );
        }
    }

    public function render()
    {
        $userId = Auth::id();

        // 1. Ambil Pesanan status 'pending' (Menunggu Konfirmasi)
        $pendingBookings = Booking::where('user_id', $userId)
            ->where('status', 'pending')
            ->with(['ticket.event'])
            ->latest()
            ->get();

        // 2. Ambil Sisanya (Approved/Rejected) sebagai Riwayat
        $historyBookings = Booking::where('user_id', $userId)
            ->where('status', '!=', 'pending')
            ->with(['ticket.event'])
            ->latest()
            ->get();

        return view('livewire.user.bookings.booking-list', [
            'pendingBookings' => $pendingBookings,
            'historyBookings' => $historyBookings
        ]);
    }
}
