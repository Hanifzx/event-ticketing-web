<?php

namespace App\Services\Admin;

use App\Models\Booking;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookingService
{
    public function getGlobalBookings(string $status = 'all', int $perPage = 10): LengthAwarePaginator
    {
        $query = Booking::with(['user', 'ticket.event.user']) 
            ->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        return $query->paginate($perPage);
    }
}