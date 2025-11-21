<?php

namespace App\Services\Organizer;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    public function getMyEvents(): Collection
    {
        return Event::where('user_id', Auth::id())
            ->orderBy('date_time', 'desc')
            ->get();
    }
    
    public function create(array $data, $image = null): Event
    {
        if ($image) {
            $data['image_path'] = $image->store('event-images', 'public');
        }
        
        // user ID diisi otomatis
        $data['user_id'] = Auth::id();

        return Event::create($data);
    }

    public function update(Event $event, array $data, $image = null): bool
    {
        if ($image) {
            // Hapus gambar lama jika ada
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $data['image_path'] = $image->store('event-images', 'public');
        }

        return $event->update($data);
    }

    public function delete(Event $event): bool
    {
        if ($event->user_id !== Auth::id()) {
            return false;
        }

        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }

        return $event->delete();
    }
}