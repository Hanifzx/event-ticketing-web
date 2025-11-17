<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;

class ManageEvents extends Component
{
    public $events;

    public function mount()
    {
        $this->loadEvents();
    }

    /**
     * Ambil SEMUA event (aku atmin kau member😁)
     */
    public function loadEvents()
    {
        $this->events = Event::with('user')
                                ->orderBy('date_time', 'desc')
                                ->get();
    }

    /**
     * Admin bisa menghapus event siapa saja.
     */
    public function delete(Event $event)
    {
        $event->delete();
        $this->loadEvents();
        session()->flash('success', 'Event berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.manage-events');
    }
}
