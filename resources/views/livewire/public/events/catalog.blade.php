<div>
    <div class="mb-8">
        @include('livewire.partials.filter')
    </div>

    <div wire:loading class="w-full text-center py-4">
        <span class="text-indigo-600 text-sm font-medium">Memuat data event...</span>
    </div>

    <div wire:loading.remove class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100 flex flex-col h-full">
                <div class="relative h-48">
                    <img src="{{ $event->image_path ? asset('storage/' . $event->image_path) : 'https://via.placeholder.com/400x200' }}" 
                         alt="{{ $event->name }}" 
                         class="w-full h-full object-cover">
                    <div class="absolute top-3 left-3">
                        <span class="bg-white/90 backdrop-blur-sm text-indigo-700 text-xs px-2 py-1 rounded-md font-bold uppercase tracking-wider shadow-sm">
                            {{ $event->category }}
                        </span>
                    </div>
                </div>
                
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        <a href="{{ route('event.show', $event->id) }}" class="hover:text-indigo-600 transition">
                            {{ $event->name }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-600 text-sm line-clamp-2 mb-4 flex-1">
                        {{ $event->description }}
                    </p>

                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-bold text-gray-900">
                                {{ \Carbon\Carbon::parse($event->date_time)->format('d M Y') }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($event->date_time)->format('H:i') }} WIB
                            </p>
                        </div>
                        <a href="{{ route('event.show', $event->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                            Detail &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-xl border border-dashed border-gray-300">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada event ditemukan</h3>
                <p class="mt-1 text-sm text-gray-500">Coba ubah filter pencarian Anda.</p>
            </div>
        @endforelse
    </div>
</div>