<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EventController extends Controller
{
    public function create(): View
    {
        return view('organizer.events.create');
    }

    public function edit(Event $event): View
    {
        // Validasi Kepemilikan (Otorisasi Ringan)
        abort_if($event->user_id !== Auth::id(), 403, 'Unauthorized action.');

        return view('organizer.events.edit', compact('event'));
    }
}