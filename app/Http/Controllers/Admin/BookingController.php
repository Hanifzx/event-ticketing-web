<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Menampilkan halaman laporan transaksi global
     */
    public function index(): View
    {
        return view('admin.bookings.index');
    }
}