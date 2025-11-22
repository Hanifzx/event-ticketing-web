<?php

namespace App\Livewire\Organizer;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class ManageBookings extends Component
{
    use WithPagination;

    public function approve($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        
        $this->authorizeEventOwnership($booking);

        $booking->update(['status' => 'approved']);
        session()->flash('message', 'Pesanan #' . $bookingId . ' berhasil disetujui.');
    }

    public function reject($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $this->authorizeEventOwnership($booking);

        // Opsional: Kembalikan kuota tiket jika ditolak
        $booking->ticket->increment('quota', $booking->quantity);

        $booking->update(['status' => 'rejected']);
        session()->flash('message', 'Pesanan #' . $bookingId . ' telah ditolak.');
    }

    private function authorizeEventOwnership($booking)
    {
        if ($booking->ticket->event->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
    }

    // #[Layout('layouts.admin')] // Asumsi pakai layout admin/organizer yang sudah ada
    public function render()
    {
        // Ambil semua booking yang Event-nya dimiliki oleh Organizer yang sedang login
        $bookings = Booking::whereHas('ticket.event', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->with(['user', 'ticket.event'])
        ->latest()
        ->paginate(10);

        return view('livewire.organizer.manage-bookings', [
            'bookings' => $bookings
        ]);
    }
}
