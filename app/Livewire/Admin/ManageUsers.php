<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ManageUsers extends Component
{
    public $users;

    // mengambil data saat komponen pertama kali dimuat
    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        // [MODIFIKASI] Ambil SEMUA user, urutkan berdasarkan role
        $this->users = User::orderBy('role')->orderBy('name')->get();
    }

    // buat Organizer
    public function approve(User $user)
    {
        if ($user->role == 'organizer') {
            $user->update(['status' => 'approved']);
            $this->loadUsers();
            session()->flash('success', 'Organizer disetujui.');
        }
    }

    // buat atmin
    public function reject(User $user)
    {
        if ($user->role == 'organizer') {
            $user->update(['status' => 'rejected']);
            $this->loadUsers();
            session()->flash('success', 'Organizer ditolak.');
        }
    }

    // buat atmin 
    public function promoteToAdmin(User $user)
    {
        if ($user->role == 'user') {
            $user->update(['role' => 'admin', 'status' => 'active']);
            $this->loadUsers();
            session()->flash('success', $user->name . ' telah dipromosikan menjadi Admin.');
        }
    }

    // buat atmin
    public function deleteUser(User $user)
    {
        if ($user->is(Auth::user())) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        $user->delete();
        $this->loadUsers();
        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.manage-users');
    }
}