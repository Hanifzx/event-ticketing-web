<?php

namespace App\Livewire\User\Bookings;

use App\Models\Booking;
use Livewire\Component;

class Detail extends Component
{
    public Booking $booking;

    public function mount(Booking $booking)
    {
        $this->booking = $booking;
    }

    // Opsional: Auto refresh setiap 5 detik untuk cek status approve
    // protected $listeners = ['echo:bookings,BookingUpdated' => '$refresh']; 

    public function render()
    {
        return view('livewire.user.bookings.detail');
    }
}
