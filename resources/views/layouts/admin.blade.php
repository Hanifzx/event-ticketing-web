<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $title ?? __('Admin Dashboard') }}
            </h2>
            
            <nav class="flex flex-row gap-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="{{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-bold underline' : 'text-gray-600 hover:text-gray-900' }}" wire:navigate>
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="{{ request()->routeIs('admin.users.index') ? 'text-blue-600 font-bold underline' : 'text-gray-600 hover:text-gray-900' }}" wire:navigate>
                    Manage Users
                </a>
                <a href="{{ route('admin.events.index') }}" 
                   class="{{ request()->routeIs('admin.events.index') ? 'text-blue-600 font-bold underline' : 'text-gray-600 hover:text-gray-900' }}" wire:navigate>
                    Manage Events
                </a>
            </nav>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>