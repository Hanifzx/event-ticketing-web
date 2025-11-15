<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        // Cek jika user sudah login
        if (Auth::check()) {
            $role = Auth::user()->role;

            // Logika pengalihan berdasarkan role
            if ($role == 'admin') {
                return view('dashboard.admin.home');
            } elseif ($role == 'organizer') {
                return view('dashboard.organizer.home');
            } else {
                return view('dashboard.user.home');
            }
        }

        return redirect('/login');
    }
}
