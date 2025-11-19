<x-dashboard-layout title="Create New Event">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800">Buat Event Baru</h2>
            <p class="text-sm text-gray-600">Isi detail di bawah ini untuk mempublikasikan event Anda.</p>
        </div>
        @livewire('organizer.event-form')
    </div>
</x-dashboard-layout>