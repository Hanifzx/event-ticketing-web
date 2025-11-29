<?php

namespace App\Livewire\Organizer;

use App\Models\Event;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\Organizer\TicketService;

class ManageTickets extends Component
{
    public Event $event;
    public $tickets;
    public ?Ticket $editingTicket = null;

    #[Rule('required|string|max:255')]
    public $name = '';

    #[Rule('required|string|max:500')]
    public $description = '';
    
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

    public function mount(Event $event, TicketService $service)
    {
        $this->event = $event;
        $this->loadTickets($service);
    }

    public function loadTickets(TicketService $service)
    {
        $this->tickets = $service->getTicketsByEvent($this->event);
    }

    public function saveTicket(TicketService $service)
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quota' => $this->quota,
            'max_purchase_per_user' => $this->max_purchase_per_user,
            'sale_start_date' => $this->sale_start_date,
            'sale_end_date' => $this->sale_end_date,
        ];

        if ($this->editingTicket) {
            // Update via Service
            $service->update($this->editingTicket, $data);
            $message = 'Tiket berhasil diperbarui!';
        } else {
            // Create via Service
            $service->create($this->event, $data);
            $message = 'Tiket baru berhasil ditambahkan!';
        }

        $this->loadTickets($service);
        $this->resetForm();

        $this->dispatch('flash-message', 
            type: 'success', 
            message: $message
        );
    }

    public function editTicket(Ticket $ticket)
    {
        $this->resetErrorBag();
        $this->editingTicket = $ticket;
        $this->name = $ticket->name;
        $this->description = $ticket->description;
        $this->price = $ticket->price;
        $this->quota = $ticket->quota;
        $this->max_purchase_per_user = $ticket->max_purchase_per_user;
        $this->sale_start_date = $ticket->sale_start_date ? $ticket->sale_start_date->format('Y-m-d\TH:i') : null;
        $this->sale_end_date = $ticket->sale_end_date ? $ticket->sale_end_date->format('Y-m-d\TH:i') : null;
    }

    public function deleteTicket(Ticket $ticket, TicketService $service)
    {
        // Otorisasi sederhana
        if($ticket->event_id !== $this->event->id) {
            abort(403);
        }

        $service->delete($ticket);
        $this->loadTickets($service);
        session()->flash('success_ticket', 'Tiket berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->reset('editingTicket', 'name', 'description', 'price', 'quota', 'max_purchase_per_user', 'sale_start_date', 'sale_end_date');
    }

    public function render()
    {
        return view('livewire.organizer.manage-tickets');
    }
}