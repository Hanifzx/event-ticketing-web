<x-app-layout title="Tentang {{ $event->name }}">

    @livewire('public.events.detail', ['event' => $event])

</x-app-layout>