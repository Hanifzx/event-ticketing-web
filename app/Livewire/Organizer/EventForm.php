<?php

namespace App\Livewire\Organizer;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventForm extends Component
{
    use WithFileUploads;

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

    #[Rule('nullable|image|max:2048')]
    public $new_image;

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

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'date_time' => $this->date_time,
            'location' => $this->location,
        ];

        if ($this->new_image) {
            if ($this->event && $this->event->image_path) {
                Storage::disk('public')->delete($this->event->image_path);
            }

            $data['image_path'] = $this->new_image->store('event-images', 'public');
        }

        if ($this->event) {
            // Mode Update
            $this->event->update($data);
            session()->flash('success', 'Event berhasil diperbarui.');

        } else {
            // Mode Create
            $data['user_id'] = Auth::id();
            
            Event::create($data);
            session()->flash('success', 'Event berhasil dibuat.');
        }

        return $this->redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.organizer.event-form');
    }
}
