<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
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

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            {{-- === BAGIAN KIRI (LOGO DAN MAIN NAV DESKTOP) === --}}
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    
                    {{-- [Public Links] --}}
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>

                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                        {{ __('Browse Events') }}
                    </x-nav-link>

                    {{-- [Dynamic Dashboard Link] --}}
                    @auth
                        <x-nav-link :href="$this->getDashboardRoute()" :active="request()->routeIs(['dashboard', 'admin.dashboard', 'organizer.dashboard'])" class="font-bold text-indigo-600">
                            {{ $this->getDashboardLabel() }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            {{-- === BAGIAN KANAN (SETTINGS & LOGIN DESKTOP) === --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                
                {{-- [Kerjasama Dengan Kami] Hanya untuk Guest/User --}}
                @if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'organizer'))
                    <a href="{{ route('organizer.register') }}" wire:navigate
                        class="text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none mr-4">
                        {{ __('Kerjasama Dengan Kami') }}
                    </a>
                @endif
                
                @auth
                    {{-- [Dropdown Profile] Hanya Profile dan Logout --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
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
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline" wire:navigate>Log in</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline" wire:navigate>Register</a>
                @endauth
            </div>

            {{-- [Hamburger Icon] --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
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
            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                {{ __('Browse Events') }}
            </x-responsive-nav-link>
            
            {{-- Kerjasama Dengan Kami (Filtered) --}}
            @if (!Auth::check() || (Auth::user()->role !== 'admin' && Auth::user()->role !== 'organizer'))
                <x-responsive-nav-link :href="route('organizer.register')" :active="request()->routeIs('organizer.register')" class="text-blue-600">
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
            <div class="px-4">
                <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
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
             <x-responsive-nav-link :href="route('login')" wire:navigate>
                {{ __('Log in') }}
            </x-responsive-nav-link>
             <x-responsive-nav-link :href="route('register')" wire:navigate>
                {{ __('Register') }}
            </x-responsive-nav-link>
        </div>
        @endauth
    </div>
</nav>