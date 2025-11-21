<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use App\Services\Event\CatalogService; 

class EventDetail extends Component
{
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render(CatalogService $service)
    {
        $tickets = $service->getEventTickets($this->event);

        return view('livewire.public.events.detail', [
            'tickets' => $tickets
        ]);
    }
}