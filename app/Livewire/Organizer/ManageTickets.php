<?php

namespace App\Livewire\Organizer;

use App\Models\Event;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\Attributes\Rule;

class ManageTickets extends Component
{
    public Event $event;
    public $tickets;

    public ?Ticket $editingTicket = null;

    #[Rule('required|string|max:255')]
    public $name = '';
    
    #[Rule('required|numeric|min:1')]
    public $price = 0;
    
    #[Rule('required|integer|min:1')]
    public $quota;
    
    #[Rule('nullable|integer|min:1')]
    public $max_purchase_per_user;
    
    #[Rule('nullable|date')]
    public $sale_start_date;
    
    #[Rule('nullable|date|after_or_equal:sale_start_date')]
    public $sale_end_date;

    /**
     * Mount: Inisialisasi komponen, terima event, dan muat tiket
     */
    public function mount(Event $event)
    {
        $this->event = $event;
        $this->loadTickets();
        $this->resetForm();
    }

    /**
     * (refresh) daftar tiket untuk event ini
     */
    public function loadTickets()
    {
        $this->tickets = $this->event->tickets()->orderBy('price')->get();
    }

    /**
     * Reset form ke state default (kosong)
     */
    public function resetForm()
    {
        $this->reset(
            'editingTicket', 'name', 'price', 'quota', 
            'max_purchase_per_user', 'sale_start_date', 'sale_end_date'
        );
        $this->resetErrorBag();
    }

    /**
     * Simpan tiket (Create atau Update)
     */
    public function saveTicket()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'price' => $this->price,
            'quota' => $this->quota,
            'max_purchase_per_user' => $this->max_purchase_per_user,
            'sale_start_date' => $this->sale_start_date,
            'sale_end_date' => $this->sale_end_date,
        ];

        if ($this->editingTicket) {
            // Mode Update
            $this->editingTicket->update($data);
            session()->flash('success_ticket', 'Tiket berhasil diperbarui.');
        } else {
            // Mode Create
            $this->event->tickets()->create($data);
            session()->flash('success_ticket', 'Tiket baru berhasil ditambahkan.');
        }

        $this->loadTickets(); 
        $this->resetForm();  
    }

    /**
     * Muat data tiket ke form untuk diedit
     */
    public function editTicket(Ticket $ticket)
    {
        $this->resetErrorBag();
        $this->editingTicket = $ticket;
        $this->name = $ticket->name;
        $this->price = $ticket->price;
        $this->quota = $ticket->quota;
        $this->max_purchase_per_user = $ticket->max_purchase_per_user;
        $this->sale_start_date = $ticket->sale_start_date ? $ticket->sale_start_date->format('Y-m-d\TH:i') : null;
        $this->sale_end_date = $ticket->sale_end_date ? $ticket->sale_end_date->format('Y-m-d\TH:i') : null;
    }

    /**
     * Hapus tiket
     */
    public function deleteTicket(Ticket $ticket)
    {
        $ticket->delete();
        $this->loadTickets();
        session()->flash('success_ticket', 'Tiket berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.organizer.manage-tickets');
    }
}
