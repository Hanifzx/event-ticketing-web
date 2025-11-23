<?php

namespace App\Services\Event;

use App\Models\Event;
use App\Livewire\Organizer\EventForm;
use Illuminate\Database\Eloquent\Collection;

class CatalogService
{
    public function getFilteredEvents(array $filters): Collection
    {
        return Event::query()
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($filters['location'] ?? null, function ($query, $location) {
                $query->where('location', 'like', '%' . $location . '%');
            })
            ->when($filters['month'] ?? null, function ($query, $month) {
                $query->whereMonth('date_time', $month);
            })
            ->orderBy('date_time', 'asc')
            ->get();
    }

    public function getUniqueLocations()
    {
        return Event::select('location')
            ->distinct()
            ->whereNotNull('location')
            ->pluck('location');
    }

    public function getCategories(): array
    {
        return EventForm::CATEGORIES;
    }
}