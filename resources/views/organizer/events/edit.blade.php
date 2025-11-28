<x-dashboard-layout title="Edit Event">
    <div class="mx-auto bg-beige">
        @livewire('organizer.event-form', ['event' => $event])
    </div>
</x-dashboard-layout>