<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;
use App\Services\Admin\EventService;

class ManageEvents extends Component
{
    public $events;

    public function mount(EventService $service)
    {
        $this->loadEvents($service);
    }

    public function loadEvents(EventService $service)
    {
        // Mengambil data via Service
        $this->events = $service->getAllEvents();
    }

    public function delete(Event $event, EventService $service)
    {
        // Delegate logika penghapusan ke Service
        $service->deleteEvent($event);
        
        $this->loadEvents($service);
        session()->flash('success', 'Event berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.manage-events');
    }
}