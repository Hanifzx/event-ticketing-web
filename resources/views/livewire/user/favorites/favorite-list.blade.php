<div>
    {{-- <div wire:loading class="w-full text-center py-4">
        <span class="text-indigo-600 text-sm font-medium">Memperbarui daftar...</span>
    </div> --}}

    @if($favorites->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" wire:loading.class="opacity-50">
            @foreach($favorites as $fav)
                @php 
                    $event = $fav->event; 
                    if(!$event) continue; 
                    $minPrice = $event->tickets->min('price') ?? 0;
                @endphp

                {{-- Card Event --}}
                <div wire:key="fav-item-{{ $fav->id }}" 
                     class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full relative">
                    
                    <a href="{{ route('event.show', $event->id) }}" class="absolute inset-0 z-0"></a>

                    <div class="relative aspect-[4/3] overflow-hidden">
                        <img src="{{ $event->image_path ? asset('storage/' . $event->image_path) : 'https://via.placeholder.com/400x300' }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        
                        <div class="absolute top-3 right-3 z-20">
                            {{-- Tombol Favorit --}}
                            <livewire:public.events.favorite-button :event="$event" wire:key="fav-btn-{{ $event->id }}" />
                        </div>
                    </div>
                    
                    <div class="p-5 flex flex-col flex-1 pointer-events-none">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-indigo-600 transition-colors relative z-10">
                            {{ $event->name }}
                        </h3>
                        <div class="text-sm text-gray-500 mb-4">
                            {{ format_date($event->date_time, 'd M Y') }} • {{ $event->location }}
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

        <div class="mt-6">
            {{ $favorites->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            <h3 class="text-lg font-medium text-gray-900">Belum ada event favorit</h3>
            <p class="text-gray-500 mt-1">Simpan event menarik di sini agar mudah ditemukan nanti.</p>
            <a href="{{ route('events.explore') }}" class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">
                Jelajahi Event
            </a>
        </div>
    @endif
</div>