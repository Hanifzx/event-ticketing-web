<?php

namespace App\Livewire\Organizer;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule; 
use Illuminate\Validation\Rule as ValidationRule;
use App\Services\Organizer\EventService;

class EventForm extends Component
{
    use WithFileUploads;

    // --- Single Source of Truth untuk Kategori ---
    public const CATEGORIES = [
        'Music',
        'Arts',
        'Sports',
        'Food',
        'Business',
        'Technology',
        'Other'
    ];

    public ?Event $event = null;

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

    // Kategori tidak pakai #[Rule] attribute, tapi lewat method rules()
    public string $category = '';

    public function rules()
    {
        return [
            'category' => ['required', 'string', ValidationRule::in(self::CATEGORIES)],
        ];
    }

    public function mount(?Event $event = null)
    {
        if ($event && $event->exists) {
            $this->event = $event;
            $this->name = $event->name;
            $this->description = $event->description;
            $this->date_time = \Carbon\Carbon::parse($event->date_time)->format('Y-m-d\TH:i');
            $this->location = $event->location;
            $this->category = $event->category;
        }
    }

    public function save(EventService $service)
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'date_time' => $this->date_time,
            'location' => $this->location,
            'category' => $this->category,
        ];

        if ($this->event) {
            $service->update($this->event, $data, $this->new_image);
            session()->flash('success', 'Event diperbarui.');
        } else {
            $newEvent = $service->create($data, $this->new_image);
            session()->flash('success', 'Event dibuat! Silakan tambah tiket.');
            return redirect()->route('organizer.events.tickets.index', $newEvent);
        }

        return redirect()->route('organizer.dashboard');
    }

    public function render()
    {
        return view('livewire.organizer.event-form', [
            'categories' => self::CATEGORIES
        ]);
    }
}