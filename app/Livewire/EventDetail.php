<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class EventDetail extends Component
{
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        $tickets = $this->event->tickets;

        return view('livewire.public.events.detail', [
            'tickets' => $tickets
        ]);
    }
}
