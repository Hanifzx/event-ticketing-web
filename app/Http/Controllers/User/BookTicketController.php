<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class BookTicketController extends Controller
{
    public function create(Event $event)
    {
        $event->load('tickets');

        return view('user.events.book-ticket', [
            'event' => $event,
        ]);
    }
}
