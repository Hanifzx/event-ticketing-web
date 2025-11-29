<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Livewire\Component;
use App\Services\Admin\EventService;
use Livewire\WithPagination;

class ManageEvents extends Component
{
    use WithPagination;

    // public function mount(EventService $service)
    // {
    //     $this->loadEvents($service);
    // }

    public function delete(Event $event, EventService $service)
    {
        // Delegate logika penghapusan ke Service
        try {
            $service->deleteEvent($event);
            
            $this->dispatch('flash-message', 
                type: 'success', 
                message: 'Event ' . $event->name . ' berhasil dihapus.'
            );

        } catch (\Exception $e) {
            $this->dispatch('flash-message', 
                type: 'error', 
                message: 'Gagal menghapus event ' . $e->getMessage()
            );
        }
    }

    public function render(EventService $service)
    {
        return view('livewire.admin.manage-events', [
            'events' => $service->getPaginatedEvents(10) 
        ]);
    }
}