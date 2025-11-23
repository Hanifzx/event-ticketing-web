<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingController extends Controller
{
    public function index()
    {
        return view('user.bookings.index');
    }
    
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->load(['ticket', 'ticket.event']);

        return view('user.bookings.show', compact('booking'));
    }

    public function downloadTicket(Booking $booking)
    {
        // 1. Otorisasi & Validasi
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'approved') {
            abort(404);
        }

        // 2. Generate QR Code
        $qrContent = 'BOOKING-ID-' . $booking->id;
        $qrcode = base64_encode(QrCode::format('svg')->size(150)->generate($qrContent));

        // 3. Generate PDF
        $pdf = Pdf::loadView('pdf.ticket', [
            'booking' => $booking,
            'qrcode' => $qrcode
        ]);

        // Set ukuran kertas
        $pdf->setPaper('A5', 'landscape');

        // 4. Download
        return $pdf->download('E-Ticket-' . $booking->id . '.pdf');
    }
}
