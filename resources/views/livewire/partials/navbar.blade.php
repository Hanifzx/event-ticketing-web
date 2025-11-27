<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;

new class extends Component
{
    public string $search = '';

    public function mount(): void
    {
        $this->search = request()->query('search', '');
    }

    public function searchEvents(): void
    {
        $this->redirect(route('events.explore', ['search' => $this->search]), navigate: false);
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    public function getDashboardRoute()
    {
        if (!Auth::check()) return route('login');

        return match (Auth::user()->role) {
            'admin' => route('admin.dashboard'),
            'organizer' => route('organizer.dashboard'),
            default => null, 
        };
    }

    public function getDashboardLabel()
    {
        if (!Auth::check()) return 'Login';

        return match (Auth::user()->role) {
            'admin' => 'Admin Panel',
            'organizer' => 'Organizer Center',
            default => null,
        };
    }
}; ?>

<nav x-data="{ open: false }" class="bg-beige sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 gap-4 md:gap-6 lg:gap-8">
            {{-- === BAGIAN KIRI (LOGO DAN MAIN NAV DESKTOP) === --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-application-logo class="block w-auto font-bold text-2xl" />
                    </a>
                </div>

                <div class="hidden space-x-4 md:space-x-6 lg:space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    
                    {{-- [Public Links] --}}
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>

                    <x-nav-link :href="route('events.explore')" :active="request()->routeIs('events.explore')">
                        {{ __('Explore') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- Search Bar --}}
            <div  class="hidden sm:flex flex-1 items-center px-4">
                <input 
                    wire:model="search" 
                    wire:keydown.enter="searchEvents"
                    type="text" 
                    placeholder="Cari Event" 
                    class="w-full max-w-xs px-4 py-1 my-3 bg-beige border border-deep-blue rounded-full shadow-smp placeholder:text-sm focus:outline-none focus:ring-gray-900 focus:border-gray-900"
                >
            </div>

            {{-- === BAGIAN KANAN (SETTINGS & LOGIN DESKTOP) === --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- [Dynamic Dashboard Link] --}}
                @auth
                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'organizer')
                        <x-nav-link :href="$this->getDashboardRoute()" :active="request()->routeIs(['admin.dashboard', 'organizer.dashboard'])"
                            class="font-bold text-indigo-600">
                            {{ $this->getDashboardLabel() }}
                        </x-nav-link>
                    @endif
                @endauth

                {{-- [Kerjasama Dengan Kami] Hanya untuk Guest/User --}}
                @if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'organizer'))
                    <a href="{{ route('organizer.register') }}" wire:navigate
                        class="hidden lg:block text-sm font-semibold text-oranye border border-transparent transition duration-150 ease-in-out hover:border-oranye focus:outline-none px-3 py-1 md:mr-2 lg:mr-3">
                        {{ __('Kerjasama Dengan Kami') }}
                    </a>
                    <a href="{{ route('organizer.register') }}" wire:navigate
                        class="hidden md:block lg:hidden text-sm font-semibold text-oranye border border-transparent transition duration-150 ease-in-out hover:border-oranye focus:outline-none px-3 py-1 md:mr-2 lg:mr-3">
                        {{ __('Kontak Kami') }}
                    </a>
                @endif
                
                @auth
                    {{-- [Dropdown Profile] Hanya Profile dan Logout --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-2 py-1 border border-transparent leading-4 font-medium hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="font-semibold text-deep-blue text-sm lg:text-sm mr-1" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                                {{-- <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div> --}}
                                <svg class="ml-1 fill-[#172a39] w-5 h-5 lg:w-6 lg:h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M224 248a120 120 0 1 0 0-240 120 120 0 1 0 0 240zm-29.7 56C95.8 304 16 383.8 16 482.3 16 498.7 29.3 512 45.7 512l356.6 0c16.4 0 29.7-13.3 29.7-29.7 0-98.5-79.8-178.3-178.3-178.3l-59.4 0z"/></svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('user.bookings.index')" wire:navigate>
                                {{ __('Pesanan') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('user.favorites.index')" wire:navigate>
                                {{ __('Favorite') }}
                            </x-dropdown-link>

                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- [Guest Links] Login/Register --}}
                    <a href="{{ route('login') }}"class="text-sm font-semibold text-oranye border border-oranye  px-3 py-1">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="ml-3 text-sm font-semibold text-beige bg-oranye border border-oranye  px-3 py-1">
                        Register
                    </a>
                @endauth
            </div>

            {{-- [Hamburger Icon] --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#172a39]/80 hover:text-[#172a39] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- === RESPONSIVE NAVIGATION MENU (MOBILE: sm:hidden) === --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        
        {{-- [A. Menu Konten Utama Mobile] --}}
        <div class="pt-2 pb-3 space-y-1">
            
            {{-- Public Links --}}
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('events.explore')" :active="request()->routeIs('events.explore')">
                {{ __('Explore Events') }}
            </x-responsive-nav-link>
            
            {{-- Kerjasama Dengan Kami (Filtered) --}}
            @if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'organizer'))
                <x-responsive-nav-link :href="route('organizer.register')" :active="request()->routeIs('organizer.register')" >
                    {{ __('Kerjasama Dengan Kami') }}
                </x-responsive-nav-link>
            @endif

            {{-- Dynamic Dashboard Link --}}
            @auth
                <x-responsive-nav-link :href="$this->getDashboardRoute()" :active="request()->routeIs(['dashboard', 'admin.dashboard', 'organizer.dashboard'])" class="text-indigo-600 font-semibold">
                    {{ $this->getDashboardLabel() }}
                </x-responsive-nav-link>
            @endauth
        </div>

        {{-- [B. Menu Pengaturan Akun Mobile] --}}
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            {{-- <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div> --}}

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('user.bookings.index')" wire:navigate>
                    {{ __('Pesanan') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('user.favorites.index')" wire:navigate>
                    {{ __('Favorite') }}
                </x-responsive-nav-link>

                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t border-gray-200">
            <x-responsive-nav-link :href="route('login')">
                {{ __('Log in') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')">
                {{ __('Register') }}
            </x-responsive-nav-link>
        </div>
        @endauth
    </div>
    {{-- Search Bar Mobile --}}
    <div class="block sm:hidden max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-4">
        <input 
            wire:model="search" 
            wire:keydown.enter="searchEvents"
            type="text" 
            placeholder="Cari Event" 
            class="w-full max-w-3xl px-4 py-1 bg-beige border border-deep-blue rounded-full shadow-smp placeholder:text-sm focus:outline-none focus:ring-gray-900 focus:border-gray-900"
        >
    </div>
</nav>