<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(Event $event): View
    {
        // Validasi Kepemilikan
        abort_if($event->user_id !== Auth::id(), 403, 'Unauthorized action.');

        return view('organizer.events.tickets', compact('event'));
    }
}