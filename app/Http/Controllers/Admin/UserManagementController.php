<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil organizer yang 'pending'
        $pendingOrganizers = User::where('role', 'organizer')
                                    ->where('status', 'pending')
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        // Ambil semua user lain (admin, user biasa, dan organizer yg sudah di-approve/reject)
        $otherUsers = User::where(function ($query) {
                                $query->where('role', '!=', 'organizer')
                                        ->orWhere('status', '!=', 'pending');
                            })
                            ->orderBy('name')
                            ->get();

        return view('dashboard.admin.users', [
            'pendingOrganizers' => $pendingOrganizers,
            'otherUsers' => $otherUsers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
