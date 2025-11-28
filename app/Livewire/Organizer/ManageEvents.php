<?php

namespace App\Livewire\Organizer;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\Organizer\EventService;

class ManageEvents extends Component
{
    // Hapus properti $events agar tidak membingungkan Livewire
    // public $events; 

    // Method mount tidak lagi diperlukan untuk load data awal
    
    public function delete(Event $event, EventService $service)
    {
        // Gunakan Facade Auth::id() agar lebih aman dan dikenali IDE
        if ($event->user_id !== Auth::id()) {
             abort(403, 'Unauthorized');
        }

        try {
            $service->delete($event);
            
            // Dispatch agar flash message muncul tanpa reload halaman
            $this->dispatch('flash-message', 
                type: 'success', 
                message: 'Event ' . $event->name . ' berhasil dihapus.'
            );

        } catch (\Exception $e) {
            $this->dispatch('flash-message', 
                type: 'error', 
                message: 'Gagal menghapus event: ' . $e->getMessage()
            );
        }
    }

    // Inject Service langsung di method render
    public function render(EventService $service)
    {
        // Ambil data fresh dari database setiap kali render
        $events = $service->getMyEvents();

        // Kirim variabel $events secara eksplisit ke view
        return view('livewire.organizer.manage-events', [
            'events' => $events
        ]);
    }
}