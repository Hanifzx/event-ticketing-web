<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Event\FavoriteService;
class FavoriteController extends Controller
{
    public function index(FavoriteService $service)
    {
        $favorites = $service->getUserFavorites(Auth::user());
        return view('user.favorites.index', compact('favorites'));
    }
}
