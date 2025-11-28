<x-dashboard-layout title="Atur Tiket Eventmu | Olinevent">
    <div class="mx-auto bg-beige">
        <div>
            @livewire('organizer.manage-tickets', ['event' => $event])
        </div>
    </div>
</x-dashboard-layout>