<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\UserService; 

class ManageUsers extends Component
{
    public $users;
    public $activeTab = 'all';

    public function mount(UserService $service)
    {
        $this->loadUsers($service);
    }

    public function setTab($tab, UserService $service)
    {
        $this->activeTab = $tab;
        $this->loadUsers($service);
    }

    public function loadUsers(UserService $service)
    {
        $allUsers = $service->getAllUsers();

        if ($this->activeTab === 'pending') {
            $this->users = $allUsers->where('role', 'organizer')
                                    ->where('status', 'pending');
        } else {
            $this->users = $allUsers;
        }
    }

    public function approve(User $user, UserService $service)
    {
        if ($service->updateOrganizerStatus($user, 'approved')) {
            $this->dispatch('flash-message', 
                type: 'success', 
                message: 'Akun OEM (Organizer) berhasil disetujui'
            );
        }
        $this->loadUsers($service);
    }

    public function reject(User $user, UserService $service)
    {
        if ($service->updateOrganizerStatus($user, 'rejected')) {
            $this->dispatch('flash-message', 
                type: 'success', 
                message: 'Pengajuan akun OEM (Organizer) ditolak'
            );
        }
        $this->loadUsers($service);
    }

    public function promoteToAdmin(User $user, UserService $service)
    {
        if ($service->promoteToAdmin($user)) {
            $this->dispatch('flash-message', 
                type: 'success', 
                message: $user->name . ' telah dipromosikan menjadi Admin.'
            );
        }
        $this->loadUsers($service);
    }

    public function deleteUser(User $user, UserService $service)
    {
        if ($user->is(Auth::user())) {
            $this->dispatch('flash-message', 
                type: 'error', 
                message: 'Anda tidak dapat menghapus akun sendiri.'
            );
            return;
        }

        $service->deleteUser($user);
        $this->loadUsers($service);
        $this->dispatch('flash-message', 
            type: 'success', 
            message: 'Pengguna berhasil dihapus.'
        );
    }

    public function render()
    {
        $pendingCount = User::where('role', 'organizer')
                            ->where('status', 'pending')
                            ->count();

        return view('livewire.admin.manage-users', [
            'pendingCount' => $pendingCount
        ]);
    }
}