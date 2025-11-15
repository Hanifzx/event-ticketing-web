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
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role == 'admin') {
            return view('dashboard.admin.home');

        } elseif ($user->role == 'organizer') {

            if ($user->status == 'approved') {
                return view('dashboard.organizer.home');
            } elseif ($user->status == 'pending') {
                return view('dashboard.organizer.pending'); 
            } else { // 'rejected'
                return view('dashboard.organizer.rejected'); 
            }

        } else { // role 'user'
            return view('dashboard.user.home');
        }
    }
    return redirect('/login');
}
}
