<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: false);
    }
}; ?>

<aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col h-full">
    
    {{-- 1. LOGO AREA  --}}
    <div class="h-16 flex items-center justify-center border-b border-gray-200">
        <a href="{{ route('home') }}" class="flex items-center gap-2 text-indigo-600 font-bold text-xl hover:text-indigo-800 transition">
            <x-application-logo class="block h-9 w-auto fill-current" />
            <span>EventApp</span>
        </a>
    </div>

    {{-- 2. NAVIGATION LINKS  --}}
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        
        {{-- === ADMIN MENU === --}}
        @if(Auth::user()->role === 'admin')
            <div class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                Administrator
            </div>

            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="w-full justify-start">
                {{ __('Dashboard') }}
            </x-nav-link>
            
            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" class="w-full justify-start">
                {{ __('Manage Users') }}
            </x-nav-link>

            <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.index')" class="w-full justify-start">
                {{ __('Manage Events') }}
            </x-nav-link>
        @endif

        {{-- === ORGANIZER MENU === --}}
        @if(Auth::user()->role === 'organizer')
            <div class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                Organizer
            </div>

            <x-nav-link :href="route('organizer.dashboard')" :active="request()->routeIs('organizer.dashboard')" class="w-full justify-start">
                {{ __('Dashboard') }}
            </x-nav-link>

            <x-nav-link :href="route('organizer.events.create')" :active="request()->routeIs('organizer.events.create')" class="w-full justify-start">
                {{ __('Create Event') }}
            </x-nav-link>
            
        @endif

        <div class="mt-6 px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
            Account
        </div>
        <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')" class="w-full justify-start">
            {{ __('Profile') }}
        </x-nav-link>

    </nav>

    {{-- 3. SIDEBAR FOOTER (User Info & Logout) --}}
    <div class="p-4 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center gap-3">
            {{-- Avatar Placeholder --}}
            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-gray-500 truncate capitalize">
                    {{ Auth::user()->role }}
                </p>
            </div>

            <button wire:click="logout" class="text-gray-400 hover:text-red-600 transition" title="Log Out">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
            </button>
        </div>
    </div>
</aside>