<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class StatusController extends Controller
{
    public function pending(): View
    {
        return view('organizer.pending');
    }

    public function rejected(): View
    {
        return view('organizer.rejected');
    }
}