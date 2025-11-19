<?php

namespace App\Livewire\Organizer;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class DeleteRejectedAccount extends Component
{
    public function deleteAccount()
    {
        $userId = Auth::id();

        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();

        if ($userId) {
            User::destroy($userId);
        }

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.organizer.delete-rejected-account');
    }
}
