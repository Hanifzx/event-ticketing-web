<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class BookTicketController extends Controller
{
    public function create(Event $event, Ticket $ticket)
    {
        if ($ticket->event_id !== $event->id) {
            abort(404);
        }

        return view('user.events.book-ticket', [
            'event' => $event,
            'ticket' => $ticket,
        ]);
    }
}
