<?php

namespace App\Livewire\User\Favorites;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Services\Event\FavoriteService;

class FavoriteList extends Component
{
    use WithPagination;

    #[On('favorite-updated')] 
    public function updateList()
    {
        // Tidak perlu isi logic, cukup dipanggil maka render() akan jalan ulang
        // dan data akan ter-refresh (item yang dihapus akan hilang)
    }

    public function render(FavoriteService $service)
    {
        return view('livewire.user.favorites.favorite-list', [
            'favorites' => $service->getUserFavorites(Auth::user())
        ]);
    }
}
