<?php

namespace App\Services\Event;

use App\Models\Ticket;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class BookingService
{
    /**
     * Handle proses booking tiket
     */
    public function createBooking(User $user, Ticket $ticket, int $quantity): Booking
    {
        // Jika salah satu gagal (misal kuota habis saat bersamaan), semua dibatalkan
        return DB::transaction(function () use ($user, $ticket, $quantity) {
            
            // 1. Lock baris tiket di DB untuk mencegah race condition
            $ticket = Ticket::where('id', $ticket->id)->lockForUpdate()->first();

            // 2. Validasi Kuota Terakhir (Database Level)
            if ($ticket->quota < $quantity) {
                throw new Exception("Mohon maaf, semua tiket telah terjual habis.");
            }

            // 3. Hitung Total Harga
            $totalPrice = $ticket->price * $quantity;

            // 4. Kurangi Kuota Tiket
            $ticket->decrement('quota', $quantity);

            // 5. Buat Record Booking
            $booking = Booking::create([
                'user_id'     => $user->id,
                'ticket_id'   => $ticket->id,
                'quantity'    => $quantity,
                'total_price' => $totalPrice,
                'status'      => 'pending',
            ]);

            return $booking;
        });
    }

    public function cancelBooking(Booking $booking)
    {
        // 1. Validasi Status
        if ($booking->status !== 'pending') {
            throw new Exception("Hanya pesanan dengan status 'pending' yang dapat dibatalkan.");
        }

        // 2. Bungkus dengan Transaksi Database
        return DB::transaction(function () use ($booking) {
            
            // A. Kembalikan Kuota Tiket
            $ticket = Ticket::where('id', $booking->ticket_id)->lockForUpdate()->first();
            
            if ($ticket) {
                $ticket->increment('quota', $booking->quantity);
            }

            // Ubah Status Booking
            $booking->update([
                'status' => 'cancelled'
            ]);

            return $booking;
        });
    }
}