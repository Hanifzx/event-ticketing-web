<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Your Events') }}
        </h2>
    </x-slot>

    <div>
        @livewire('organizer.manage-events')
    </div>
</x-app-layout>