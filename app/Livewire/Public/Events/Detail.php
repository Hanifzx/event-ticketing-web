<?php

namespace App\Livewire\Public\Events;

use App\Models\Event;
use Livewire\Component;
use App\Services\Event\CatalogService; 

class Detail extends Component
{
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        // Ambil tiket termurah
        $cheapestTicket = $this->event
            ->tickets()
            ->orderBy('price', 'asc')
            ->first();

        return view('livewire.public.events.detail', [
            'cheapestTicket' => $cheapestTicket,
        ]);
    }
}