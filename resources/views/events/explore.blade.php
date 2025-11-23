<x-base-layout title="Explore Events">
    <livewire:partials.navbar />

    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Jelajahi Semua Event
                </h1>
                <p class="mt-2 text-lg text-gray-600">
                    Temukan event menarik di sekitarmu dan pesan tiketnya sekarang.
                </p>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <div class="py-12 min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Catalog Component sudah mencakup Filter (via include) dan Grid --}}
            <livewire:public.events.catalog />

        </div>
    </div>
</x-base-layout>