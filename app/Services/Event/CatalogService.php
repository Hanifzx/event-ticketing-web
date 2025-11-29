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
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%')
                      ->orWhere('location', 'like', '%' . $search . '%');
                });
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            })
            ->when($filters['location'] ?? null, function ($query, $location) {
                $query->where(function($q) use ($location) {
                    $q->where('location', 'LIKE', '%' . $location)
                      ->orWhere('location', 'LIKE', '%' . $location . '.');
                });
            })
            ->when($filters['month'] ?? null, function ($query, $month) {
                $query->whereMonth('date_time', $month);
            })
            ->orderBy('date_time', 'asc')
            ->get();
    }

    public function getUniqueLocations()
    {
        $rawLocations = Event::whereNotNull('location')->pluck('location');

        return $rawLocations->map(function ($fullAddress) {
            $cleanAddress = rtrim($fullAddress, '.');

            $parts = explode(',', $cleanAddress);

            $city = end($parts);

            return trim($city);
        })
        ->filter()
        ->unique()
        ->sort()
        ->values();
    }

    public function getCategories(): array
    {
        return EventForm::CATEGORIES;
    }
}