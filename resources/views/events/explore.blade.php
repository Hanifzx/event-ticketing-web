<x-base-layout title="Explore Events">
    <livewire:partials.navbar />

    <header class= shadow-sm">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-900">
                Jelajahi Semua Event
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Temukan event menarik di sekitarmu dan pesan tiketnya sekarang.
            </p>
        </div>
    </header>

    {{-- Main Content --}}
    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
            
                <livewire:event-catalog />

            </div>
        </div>
    </div>
</x-base-layout>