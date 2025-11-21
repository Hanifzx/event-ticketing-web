<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\Auth\RedirectService;

class HomeController extends Controller
{
    protected $redirectService;

    // Inject Service
    public function __construct(RedirectService $redirectService)
    {
        $this->redirectService = $redirectService;
    }

    public function index(Request $request): RedirectResponse
    {
        // Panggil logika dari service
        $targetRoute = $this->redirectService->getHomeRoute($request->user());
        
        return redirect()->route($targetRoute);
    }
}