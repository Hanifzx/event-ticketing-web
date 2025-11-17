<?php

namespace App\Livewire\Organizer;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventForm extends Component
{
    //Properti untuk menampung event yg diedit (jika ada)
    public ?Event $event = null;

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
     * Inisialisasi komponen (mengisi form jika mode edit)
     */
    public function mount(?Event $event = null)
    {
        if ($event->exists) {
            $this->event = $event;
            $this->name = $event->name;
            $this->description = $event->description;
            $this->date_time = \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i'); 
            $this->location = $event->location;
        }
    }

    /**
     * buat submit form create dan edit
     */
    public function save()
    {
        $this->validate();

        if ($this->event) {
            $this->event->update([
                'name' => $this->name,
                'description' => $this->description,
                'date_time' => $this->date_time,
                'location' => $this->location,
            ]);
            session()->flash('success', 'Event berhasil diperbarui.');

        } else {
            Event::create([
                'user_id' => Auth::id(),
                'name' => $this->name,
                'description' => $this->description,
                'date_time' => $this->date_time,
                'location' => $this->location,
            ]);
            session()->flash('success', 'Event berhasil dibuat.');
        }

        return $this->redirect(route('dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.organizer.event-form');
    }
}
