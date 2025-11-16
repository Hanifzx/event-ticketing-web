<?php

namespace App\Livewire\Organizer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class ManageEvents extends Component
{
    public $events;

    /**
     * Muat data event saat komponen di-load
     */
    public function mount()
    {
        $this->loadEvents();
    }

    /**
     * Fungsi untuk mengambil event milik organizer ini
     */
    public function loadEvents()
    {
        $this->events = Event::where('user_id', Auth::id())
                                ->orderBy('date_time', 'desc')
                                ->get();
    }

    /**
     * Tampilkan view
     */
    public function render()
    {
        return view('livewire.organizer.manage-events');
    }
}
