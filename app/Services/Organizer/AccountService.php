<?php

namespace App\Services\Organizer;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountService
{
    public function deleteRejectedAccount(): void
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if ($user) {
            // Logout & Invalidate Session
            Auth::guard('web')->logout();
            Session::invalidate();
            Session::regenerateToken();

            // Hapus data
            $user->delete();
        }
    }
}