<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function getAllUsers(): Collection
    {
        return User::orderBy('role')->orderBy('name')->get();
    }

    public function updateOrganizerStatus(User $user, string $status): bool
    {
        if ($user->role !== 'organizer') {
            return false;
        }
        return $user->update(['status' => $status]);
    }

    public function promoteToAdmin(User $user): bool
    {
        if ($user->role !== 'user') {
            return false;
        }
        return $user->update([
            'role'   => 'admin',
            'status' => 'active'
        ]);
    }

    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }
}