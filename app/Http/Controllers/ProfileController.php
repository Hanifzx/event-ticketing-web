<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil user.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'organizer') {
            return view('profile.dashboard', [
                'user' => $user,
            ]);
        }

        return view('profile.edit', [
            'user' => $user,
        ]);
    }
}
