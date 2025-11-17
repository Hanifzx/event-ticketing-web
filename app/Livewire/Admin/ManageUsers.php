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
        $this->users = User::orderBy('role')->orderBy('name')->get();
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

    public function promoteToAdmin(User $user)
    {
        if ($user->role == 'user') {
            $user->update(['role' => 'admin', 'status' => 'active']);
            $this->loadUsers();
            session()->flash('success', $user->name . ' telah dipromosikan menjadi Admin.');
        }
    }

    /**
     * Hapus User
     */
    public function delete(User $user)
    {
        if ($user->is(Auth::user())) {
            session()->flash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
            return;
        }

        $user->delete();
        $this->loadUsers();
        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    // Fungsi untuk render view
    public function render()
    {
        return view('livewire.admin.manage-users');
    }
}
