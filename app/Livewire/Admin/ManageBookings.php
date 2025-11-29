<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Admin\BookingService;

class ManageBookings extends Component
{
    use WithPagination;

    public $activeTab = 'all';

    public function setTab($status)
    {
        $this->activeTab = $status;
        $this->resetPage(); 
    }

    public function render(BookingService $service)
    {
        $bookings = $service->getGlobalBookings($this->activeTab, 10);

        $pendingCount = \App\Models\Booking::where('status', 'pending')->count();

        return view('livewire.admin.manage-bookings', [
            'bookings' => $bookings,
            'pendingCount' => $pendingCount
        ]);
    }
}