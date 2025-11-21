<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\UserService; 

class ManageUsers extends Component
{
    public $users;

    public function mount(UserService $service)
    {
        $this->loadUsers($service);
    }

    public function loadUsers(UserService $service)
    {
        $this->users = $service->getAllUsers();
    }

    public function approve(User $user, UserService $service)
    {
        if ($service->updateOrganizerStatus($user, 'approved')) {
            session()->flash('success', 'Organizer disetujui.');
        }
        $this->loadUsers($service);
    }

    public function reject(User $user, UserService $service)
    {
        if ($service->updateOrganizerStatus($user, 'rejected')) {
            session()->flash('success', 'Organizer ditolak.');
        }
        $this->loadUsers($service);
    }

    public function promoteToAdmin(User $user, UserService $service)
    {
        if ($service->promoteToAdmin($user)) {
            session()->flash('success', $user->name . ' telah dipromosikan menjadi Admin.');
        }
        $this->loadUsers($service);
    }

    public function deleteUser(User $user, UserService $service)
    {
        if ($user->is(Auth::user())) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        $service->deleteUser($user);
        $this->loadUsers($service);
        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.manage-users');
    }
}