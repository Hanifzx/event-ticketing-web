<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\Url;
class EventCatalog extends Component
{
    #[Url]
    public $search = '';

    public function render()
    {
        $query = Event::query()
            ->whereHas('user', function ($q) {
                $q->where('role', 'organizer')
                    ->where('status', 'approved');
            })
            ->where('date_time', '>=', now())
            ->orderBy('date_time', 'asc');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        $events = $query->get();

        return view('livewire.public.events.catalog', [
            'events' => $events
        ]);
    }
}
