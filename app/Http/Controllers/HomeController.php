<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return view('admin.dashboard');
        } elseif ($role === 'organizer') {
            if (Auth::user()->status === 'pending') {
                return view('organizer.pending');
            }
            return view('organizer.dashboard'); 
        } else {
            return view('user.dashboard');
        }
    }
}
