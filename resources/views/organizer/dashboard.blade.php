<x-dashboard-layout title="Organizer Dashboard">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-sm font-medium text-gray-500">Active Events</h3>
            <p class="text-3xl font-bold text-indigo-600 mt-2">3</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-sm font-medium text-gray-500">Total Tickets Sold</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">150</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-sm font-medium text-gray-500">Total Revenue</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">Rp 12.500.000</p>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="font-bold text-lg mb-4">Your Events</h3>
            <livewire:organizer.manage-events />
        </div>
    </div>
</x-dashboard-layout>