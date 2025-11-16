<?php

namespace App\Livewire\Organizer;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventForm extends Component
{
     // Properti untuk menampung data form
    #[Rule('required|string|min:5|max:255')]
    public string $name = '';

    #[Rule('required|string|min:20')]
    public string $description = '';

    #[Rule('required|date')]
    public string $date_time = '';

    #[Rule('required|string|max:255')]
    public string $location = '';

    /**
     * buat submit form
     */
    public function save()
    {
        $this->validate();

        Event::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'description' => $this->description,
            'date_time' => $this->date_time,
            'location' => $this->location,
            // 'image_path'
        ]);

        session()->flash('success', 'Event berhasil dibuat.');

        return $this->redirect(route('dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.organizer.event-form');
    }
}
