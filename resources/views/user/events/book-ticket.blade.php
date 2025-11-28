<x-app-layout title="Tiket untuk {{ $event->name }} | Olinevent">
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900">{{ $event->name }}</h1>
                <p class="text-gray-600 mt-2">{{ format_date($event->date_time) }} di {{ $event->location }}</p>
            </div>

            <div class="flex flex-wrap justify-center items-start gap-6">
                @forelse($event->tickets as $ticket)
                    
                    <livewire:user.events.book-ticket :ticket="$ticket" :key="$ticket->id" />
                    
                @empty
                    <div class="col-span-2 text-center py-10 bg-white rounded-lg shadow">
                        <p class="text-gray-500">Belum ada tiket yang tersedia untuk event ini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>