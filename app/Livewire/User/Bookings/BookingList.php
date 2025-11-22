<?php

namespace App\Livewire\User\Bookings;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingList extends Component
{
    public function cancelBooking($id)
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        // Validasi: Hanya bisa hapus jika status masih pending
        if ($booking && $booking->status === 'pending') {
            
            // kembalikan Kuota Tiket
            $booking->ticket->increment('quota', $booking->quantity);

            $booking->delete();

            session()->flash('message', 'Pesanan berhasil dibatalkan.');
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
