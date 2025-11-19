<x-dashboard-layout title="Manage Tickets">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800">Manajemen Tiket</h2>
        <p class="text-sm text-gray-600">Atur jenis dan harga tiket untuk event: <strong>{{ $event->title }}</strong></p>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            @livewire('organizer.manage-tickets', ['event' => $event])
        </div>
    </div>
</x-dashboard-layout>