<?php

namespace App\Services\Admin;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventService
{
    public function getAllEvents(): Collection
    {
        return Event::with('user')
            ->orderBy('date_time', 'desc')
            ->get();
    }

    public function getPaginatedEvents(int $perPage = 10): LengthAwarePaginator
    {
        return Event::with('user')
            ->orderBy('date_time', 'desc')
            ->paginate($perPage);
    }

    public function deleteEvent(Event $event): bool
    {
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }
        return $event->delete();
    }
}