<x-dashboard-layout title="Edit Event">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Edit Event</h2>
                <p class="text-sm text-gray-600">Perbarui informasi event Anda.</p>
            </div>
            <a href="{{ route('organizer.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">
                &larr; Kembali ke Dashboard
            </a>
        </div>

        @livewire('organizer.event-form', ['event' => $event])
    </div>
</x-dashboard-layout>