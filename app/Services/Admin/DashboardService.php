<?php

namespace App\Services\Admin;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class DashboardService
{
    /**
     * Mengambil semua statistik untuk Dashboard Admin
     */
    public function getDashboardStats(): array
    {
        // 1. Statistik Penjualan
        $totalRevenue = Booking::where('status', 'approved')->sum('total_price');
        $ticketsSold = Booking::where('status', 'approved')->sum('quantity');
        
        // 2. Statistik Event
        $activeEvents = Event::where('date_time', '>=', Carbon::now())->count();
        
        // 3. Statistik Organizer
        $totalOrganizers = User::where('role', 'organizer')->count();
        $pendingOrganizers = User::where('role', 'organizer')
                                ->where('status', 'pending')
                                ->count();

        // 4. Data Transaksi Terbaru
        $recentBookings = Booking::with(['user', 'ticket.event'])
            ->latest()
            ->take(5)
            ->get();

        return [
            'totalRevenue'      => $totalRevenue,
            'ticketsSold'       => $ticketsSold,
            'activeEvents'      => $activeEvents,
            'totalOrganizers'   => $totalOrganizers,
            'pendingOrganizers' => $pendingOrganizers,
            'recentBookings'    => $recentBookings,
        ];
    }
}