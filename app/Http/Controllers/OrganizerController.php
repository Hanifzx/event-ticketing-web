<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function dashboard() {
        return view('organizer.dashboard');
    }

    public function pending() {
        return view('organizer.pending');
    }
    
    public function rejected() {
        return view('organizer.rejected');
    }

    public function createEvent() {
        return view('organizer.events.create');
    }

    public function editEvent(Event $event) {
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('organizer.events.edit', compact('event'));
    }

    public function manageTickets(Event $event) {
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('organizer.events.tickets', compact('event'));
    }
}
