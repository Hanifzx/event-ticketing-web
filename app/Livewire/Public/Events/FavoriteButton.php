<?php

namespace App\Livewire\Public\Events;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Services\Event\FavoriteService;

class FavoriteButton extends Component
{
    public Event $event;
    public bool $isFavorite = false;

    public function mount(Event $event)
    {
        $this->event = $event;
        if (Auth::check()) {
            $this->isFavorite = $this->event->isFavoritedBy(Auth::user());
        }
    }

    public function toggle(FavoriteService $service)
    {
        // 1. Logic Guest -> Redirect Register
        if (!Auth::check()) {
            return $this->redirect(route('register'), navigate: true);
        }

        // 2. Logic User -> Panggil Service
        $this->isFavorite = $service->toggle(Auth::user(), $this->event);
    }

    public function render()
    {
        return view('livewire.public.events.favorite-button');
    }
}
