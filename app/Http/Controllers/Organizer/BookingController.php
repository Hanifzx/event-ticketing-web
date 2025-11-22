<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Menampilkan halaman daftar pesanan (Wrapper).
     */
    public function index()
    {
        return view('organizer.bookings.index');
    }
}
