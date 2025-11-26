<x-app-layout title:="Event Favorit | Olinevent">
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Event Favorit Saya') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-beige">
            
            <livewire:user.favorites.favorite-list />

        </div>
    </div>
</x-app-layout>