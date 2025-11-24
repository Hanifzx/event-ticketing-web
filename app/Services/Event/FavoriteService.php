<?php

namespace App\Services\Event;

use App\Models\Event;
use App\Models\Favorite;
use App\Models\User;

class FavoriteService
{
    public function toggle(User $user, Event $event): bool
    {
        $exists = Favorite::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if ($exists) {
            $exists->delete();
            return false;
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'event_id' => $event->id
            ]);
            return true;
        }
    }

    public function getUserFavorites(User $user)
    {
        return $user->favorites()
            ->with('event') 
            ->latest()
            ->paginate(9);
    }
}