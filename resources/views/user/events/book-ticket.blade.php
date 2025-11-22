<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Confirmation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <!-- Memanggil Livewire Component dengan parameter ticket -->
            <livewire:user.events.book-ticket :ticket="$ticket" />
        </div>
    </div>
</x-app-layout>