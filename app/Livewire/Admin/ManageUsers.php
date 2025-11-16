<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ManageUsers extends Component
{
    public $pendingOrganizers;
    public $otherUsers;

    // mengambil data saat komponen pertama kali dimuat
    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->pendingOrganizers = User::where('role', 'organizer')
                                        ->where('status', 'pending')
                                        ->orderBy('created_at', 'desc')
                                        ->get();

        $this->otherUsers = User::where(function ($query) {
                                $query->where('role', '!=', 'organizer')
                                        ->orWhere('status', '!=', 'pending');
                            })
                            ->orderBy('name')
                            ->get();
    }

    public function approve(User $user)
    {
        if ($user->role == 'organizer' && $user->status == 'pending') {
            $user->update(['status' => 'approved']);
            $this->loadUsers(); // Ambil ulang data (refresh view)
            session()->flash('success', 'Organizer disetujui.');
        }
    }

    public function reject(User $user)
    {
        if ($user->role == 'organizer' && $user->status == 'pending') {
            $user->update(['status' => 'rejected']);
            $this->loadUsers(); // Ambil ulang data
            session()->flash('success', 'Organizer ditolak.');
        }
    }

    // Fungsi untuk render view
    public function render()
    {
        return view('livewire.admin.manage-users');
    }
}
