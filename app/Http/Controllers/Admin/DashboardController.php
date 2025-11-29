<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    public function index(DashboardService $service): View
    {
        $data = $service->getDashboardStats();

        return view('admin.dashboard', $data);
    }
}