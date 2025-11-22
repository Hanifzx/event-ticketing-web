<?php

namespace App\Livewire\User\Bookings;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingList extends Component
{
    public function render()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['ticket.event'])
            ->latest()
            ->get();

        return view('livewire.user.bookings.booking-list', [
            'bookings' => $bookings
        ]);
    }
}
