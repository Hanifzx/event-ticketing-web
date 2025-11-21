<?php

namespace App\Services\Organizer;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

class TicketService
{
    public function getTicketsByEvent(Event $event): Collection
    {
        return $event->tickets()->orderBy('price')->get();
    }

    public function create(Event $event, array $data): Ticket
    {
        return $event->tickets()->create($data);
    }

    public function update(Ticket $ticket, array $data): bool
    {
        return $ticket->update($data);
    }

    public function delete(Ticket $ticket): bool
    {
        return $ticket->delete();
    }
}