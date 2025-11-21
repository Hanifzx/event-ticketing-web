<?php

namespace App\Livewire\Organizer;

use Livewire\Component;
use App\Services\Organizer\AccountService;

class DeleteRejectedAccount extends Component
{
    public function deleteAccount(AccountService $service)
    {
        $service->deleteRejectedAccount();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.organizer.delete-rejected-account');
    }
}