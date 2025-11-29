<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OrganizerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role !== 'organizer' && $user->role !== 'admin') {
            return redirect()->route('dashboard'); 
        }

        if ($user->role === 'organizer') {
            
            $status = $user->status;

            if ($status === 'pending') {
                if ($request->routeIs('organizer.pending')) {
                    return $next($request);
                }
                return redirect()->route('organizer.pending');
            }

            if ($status === 'rejected') {
                if ($request->routeIs('organizer.rejected')) {
                    return $next($request);
                }
                return redirect()->route('organizer.rejected');
            }

            if ($status === 'approved') {
                if ($request->routeIs('organizer.pending') || $request->routeIs('organizer.rejected')) {
                    return redirect()->route('organizer.dashboard');
                }
            }
        }

        return $next($request);
    }
}
