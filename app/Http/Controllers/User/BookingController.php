<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use ZipArchive;
use Illuminate\Support\Facades\File;

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

    /**
     * Generate Multiple PDF Tickets & Download as ZIP
     */
    public function downloadTickets(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) abort(403);
        if ($booking->status !== 'approved') abort(404);

        // Siapkan Folder Temporary (storage_path)
        $tempDir = storage_path('app/public/temp_tickets/' . $booking->id);
        
        // Pastikan folder ada, jika tidak buat baru
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0755, true);
        }

        // Loop Sesuai Quantity Tiket untuk generate PDF per tiket
        for ($i = 1; $i <= $booking->quantity; $i++) {
            
            // Generate ID Unik Tiket (Virtual)
            // Format: TKT-{BookingID}-{Urutan}-{RandomString}
            $uniqueCode = strtoupper(substr(md5($booking->id . $i . $booking->created_at->timestamp), 0, 5));
            $ticketId = sprintf("TKT-%d-%02d-%s", $booking->id, $i, $uniqueCode);

            // Generate QR Code
            $qrCode = base64_encode(QrCode::format('svg')->size(150)->generate($ticketId));

            // Render PDF dari View
            $pdf = Pdf::loadView('pdf.ticket', [
                'booking' => $booking,
                'qrcode' => $qrCode,
                'ticketId' => $ticketId,
                'sequence' => $i
            ]);
            
            $pdf->setPaper('A5', 'landscape');

            // Simpan PDF ke Folder Temp
            $fileName = "Tiket-{$i}-{$ticketId}.pdf";
            $pdf->save($tempDir . '/' . $fileName);
        }

        // Buat File ZIP
        $zipFileName = 'E-Tickets-Booking-' . $booking->id . '.zip';
        $zipFilePath = storage_path('app/public/' . $zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // Ambil semua file PDF dari folder temp
            $files = File::files($tempDir);
            
            foreach ($files as $key => $value) {
                // Masukkan file ke dalam ZIP dengan nama file aslinya
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }

        // Hapus Folder Temp (Cleanup agar server tidak penuh)
        File::deleteDirectory($tempDir);

        // Download ZIP & Hapus File ZIP setelah dikirim ke user
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
