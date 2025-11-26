<x-base-layout title="Explore Events">
    <livewire:partials.navbar />

    <header class="bg-beige shadow-sm">
        <div class="max-w-7xl mx-auto pt-5 pb-4 px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl lg:text-4xl font-bold text-deep-blue">
                    Jelajahi Semua Event
                </h1>
                <p class="mt-2 text-md md:text-lg text-deep-blue">
                    Temukan event menarik di sekitarmu dan pesan tiketnya sekarang.
                </p>
            </div>
            <div id="catalog-filter-target"></div>
        </div>
    </header>

    {{-- Main Content --}}
    <div class="min-h-screen bg-beige">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <livewire:public.events.catalog />

        </div>
    </div>
</x-base-layout>