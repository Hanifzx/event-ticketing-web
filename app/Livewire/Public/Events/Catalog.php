<?php

namespace App\Livewire\Public\Events;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Services\Event\CatalogService;

class Catalog extends Component
{
    #[Url]
    public $search = '';

    public function render(CatalogService $service)
    {
        $events = $service->getPublicEvents($this->search);

        return view('livewire.public.events.catalog', [
            'events' => $events
        ]);
    }
}