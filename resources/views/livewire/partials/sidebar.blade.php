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

<aside class="hidden lg:flex flex-col w-64 bg-white border-r border-gray-100 rounded-r-3xl min-h-screen fixed left-0 z-30 pt-3 pb-10 overflow-y-auto transition-all duration-300 shadow-[4px_0_24px_rgba(0,0,0,0.20)]">
    {{-- 1. LOGO AREA  --}}
    <div class="h-16 flex items-center justify-center">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-x transition">
            <x-application-logo class="block h-9 w-auto fill-current" />
        </a>
    </div>

    {{-- 1. NAVIGATION LINKS  --}}
    <nav class="flex-1 px-4 space-y-2">
        
        {{-- ========================================= --}}
        {{-- MENU ADMIN --}}
        {{-- ========================================= --}}
        @if(Auth::user()->role === 'admin')
            
            <div class="mb-3 mt-2 px-4 text-[10px] font-bold text-gray-700 uppercase tracking-widest">
                Administrator
            </div>

            <a href="{{ route('admin.dashboard') }}" 
               wire:navigate
               class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 
                      {{ request()->routeIs('admin.dashboard') 
                         ? 'bg-oranye text-white font-semibold shadow-md shadow-[#172a39]/20' 
                         : 'text-deep-blue font-semibold hover:bg-[#fc563c]/10 hover:text-[#fc563c]' }}">
                
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-700 group-hover:text-[#fc563c]' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.users.index') }}" 
               wire:navigate
               class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 
                      {{ request()->routeIs('admin.users.*') 
                         ? 'bg-oranye text-white font-semibold shadow-md shadow-[#172a39]/20' 
                         : 'text-deep-blue font-semibold hover:bg-[#fc563c]/10 hover:text-[#fc563c]' }}">
                
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-700 group-hover:text-[#fc563c]' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="text-sm">Manage Users</span>
            </a>

            <a href="{{ route('admin.events.index') }}" 
               wire:navigate
               class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 
                      {{ request()->routeIs('admin.events.*') 
                         ? 'bg-oranye text-white font-semibold shadow-md shadow-[#172a39]/20' 
                         : 'text-deep-blue font-semibold hover:bg-[#fc563c]/10 hover:text-[#fc563c]' }}">
                
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('admin.events.*') ? 'text-white' : 'text-gray-700 group-hover:text-[#fc563c]' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="text-sm">Manage Event</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}" 
               wire:navigate
               class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 
                      {{ request()->routeIs('admin.bookings.*') 
                         ? 'bg-oranye text-white font-semibold shadow-md shadow-[#172a39]/20' 
                         : 'text-deep-blue font-semibold hover:bg-[#fc563c]/10 hover:text-[#fc563c]' }}">
                
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('admin.bookings.*') ? 'text-white' : 'text-gray-700 group-hover:text-[#fc563c]' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                <span class="text-sm">Ticket Sales Report</span>
            </a>

        @endif

        {{-- ========================================= --}}
        {{-- MENU ORGANIZER --}}
        {{-- ========================================= --}}
        @if(Auth::user()->role === 'organizer')
            
            <div class="mb-3 mt-2 px-4 text-[10px] font-bold text-gray-700 uppercase tracking-widest">
                Organizer Center
            </div>

            <a href="{{ route('organizer.dashboard') }}" 
               wire:navigate
               class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 
                      {{ request()->routeIs('organizer.dashboard') 
                         ? 'bg-oranye text-white font-semibold shadow-md shadow-[#172a39]/20' 
                         : 'text-deep-blue font-semibold hover:bg-[#fc563c]/10 hover:text-[#fc563c]' }}">
                
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('organizer.dashboard') ? 'text-white' : 'text-gray-700 group-hover:text-[#fc563c]' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="{{ route('organizer.events.create') }}" 
               wire:navigate
               class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 
                      {{ request()->routeIs('organizer.events.create') 
                         ? 'bg-oranye text-white font-semibold shadow-md shadow-[#172a39]/20' 
                         : 'text-deep-blue font-semibold hover:bg-[#fc563c]/10 hover:text-[#fc563c]' }}">
                
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('organizer.events.create') ? 'text-white' : 'text-gray-700 group-hover:text-[#fc563c]' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-sm">Buat Event</span>
            </a>

            <a href="{{ route('organizer.bookings.index') }}" 
               wire:navigate
               class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 
                      {{ request()->routeIs('organizer.bookings.*') 
                         ? 'bg-oranye text-white font-semibold shadow-md shadow-[#172a39]/20' 
                         : 'text-deep-blue font-semibold hover:bg-[#fc563c]/10 hover:text-[#fc563c]' }}">
                
                <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('organizer.bookings.*') ? 'text-white' : 'text-gray-700 group-hover:text-[#fc563c]' }}" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                <span class="text-sm">Pesanan Masuk</span>
            </a>

        @endif

        <div class="mb-3 px-4 pt-3 text-[10px] font-bold text-gray-700 uppercase tracking-widest">
            Pengaturan
        </div>
        
        <a href="{{ route('profile') }}" 
           wire:navigate
           class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 
                  {{ request()->routeIs('profile') 
                     ? 'bg-oranye text-white font-semibold shadow-md shadow-[#172a39]/20' 
                     : 'text-deep-blue font-semibold hover:bg-[#fc563c]/10 hover:text-[#fc563c]' }}">
            
            <svg class="w-5 h-5 mr-3 transition-colors duration-200 {{ request()->routeIs('profile') ? 'text-white' : 'text-gray-700 group-hover:text-[#fc563c]' }}" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-sm">Profil Saya</span>
        </a>

    </nav>

    {{-- 2. SIDEBAR FOOTER (User Info & Logout) --}}
    <div class="px-4 mt-auto">
        <div class="flex items-center gap-3 px-1">
            
            {{-- Avatar Placeholder --}}
            <div class="w-10 h-10 rounded-full bg-beige flex items-center justify-center text-[#fc563c] font-bold text-sm border border-black">
                OEM
            </div>
            
            <div class="flex-1 min-w-0">
                <p class="text-md text-deep-blue font-semibold truncate">
                    {{ Auth::user()->name }}
                </p>
                <p class="text-xs text-gray-500 truncate capitalize tracking-wide">
                    {{ Auth::user()->role }}
                </p>
            </div>

            {{-- Logout --}}
            <button wire:click="logout" 
                    class="p-1.5 rounded-lg text-gray-700 hover:text-red-600 hover:bg-red-50 transition-all duration-200" 
                    title="Log Out">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
            </button>
        </div>
    </div>

</aside>