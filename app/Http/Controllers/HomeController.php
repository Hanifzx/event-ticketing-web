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
            return redirect()->route('admin.dashboard');
        } 
        
        if ($role === 'organizer') {
            if (Auth::user()->status === 'pending') {
                return redirect()->route('organizer.pending');
            }
            return redirect()->route('organizer.dashboard');
        } 

        return redirect()->route('home');
    }
}
