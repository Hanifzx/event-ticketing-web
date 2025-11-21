<?php

namespace App\Services\Auth;

use App\Models\User;

class RedirectService
{
    /**
     * Menentukan rute dashboard berdasarkan role pengguna.
     */
    public function getHomeRoute(User $user): string
    {
        if ($user->role === 'admin') {
            return 'admin.dashboard';
        }

        if ($user->role === 'organizer') {
            // Cek status organizer
            if ($user->status === 'pending') {
                return 'organizer.pending';
            }
            if ($user->status === 'rejected') {
                return 'organizer.rejected';
            }
            return 'organizer.dashboard';
        }

        // Default user / guest
        return 'home';
    }
}