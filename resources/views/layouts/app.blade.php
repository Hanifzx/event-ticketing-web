<x-base-layout :title="$title ?? 'EventApp'">
    <div class="min-h-screen bg-gray-100">
        <livewire:partials.navbar />

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</x-base-layout>