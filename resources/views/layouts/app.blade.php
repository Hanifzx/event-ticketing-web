<x-base-layout :title="$title ?? 'Olinevent'">
    <div class="min-h-screen bg-beige">
        <livewire:partials.navbar />

        @if (isset($header))
            <header class="bg-beige">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>

        {{-- <footer>
            {{ $slot }}
        </footer> --}}

        <x-flash-message />
    </div>
</x-base-layout>