<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('INI ADALAH DASHBOARD ADMIN') }}
        </h2>
    </x-slot>

    <div>
        @livewire('admin.manage-users')
    </div>
</x-app-layout>
