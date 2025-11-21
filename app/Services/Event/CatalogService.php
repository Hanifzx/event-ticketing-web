<?php

namespace App\Services\Event;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

class CatalogService
{
    public function getPublicEvents(string $search = ''): Collection
    {
        $query = Event::query()
            ->whereHas('user', function ($q) {
                $q->where('role', 'organizer')
                    ->where('status', 'approved');
            })
            ->where('date_time', '>=', now())
            ->orderBy('date_time', 'asc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        return $query->get();
    }

    /**
     * Mengambil tiket untuk detail event (Public).
     */
    public function getEventTickets(Event $event): Collection
    {
        return $event->tickets()
            ->orderBy('price', 'asc')
            ->get();
    }
}