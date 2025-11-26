<div>
    @if($favorites->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" wire:loading.class="opacity-50">
            @foreach($favorites as $fav)
                @php 
                    $event = $fav->event; 
                    if(!$event) continue; 
                    $minPrice = $event->tickets->min('price') ?? 0;
                    $imageUrl = $event->image_path 
                        ? asset('storage/' . $event->image_path) 
                        : 'https://via.placeholder.com/400x300';
                @endphp

                {{-- CARD WRAPPER --}}
                <div class="relative group">

                    {{-- FAVORITE BUTTON --}}
                    <div class="absolute top-3 right-3 z-[99]" @click.stop>
                        <livewire:public.events.favorite-button 
                            :event="$event" 
                            wire:key="fav-btn-{{ $event->id }}" 
                        />
                    </div>

                    {{-- CARD --}}
                    <a href="{{ route('event.show', $event->id) }}"
                        wire:key="event-{{ $event->id }}"
                        class="block bg-beige border shadow-md border-gray-200 rounded-xl overflow-hidden h-full flex flex-col relative">

                        {{-- FOTO EVENT --}}
                        <div class="relative h-48 w-full overflow-hidden bg-gray-100">

                            {{-- Layer blur --}}
                            <div class="absolute inset-0">
                                <img src="{{ $imageUrl }}"
                                    class="w-full h-full object-cover blur-xl scale-110 opacity-50">
                            </div>

                            {{-- Gambar utama --}}
                            <div class="relative h-full w-full flex justify-center items-center z-10">
                                <img src="{{ $imageUrl }}"
                                    alt="{{ $event->name }}"
                                    class="h-full w-auto object-contain shadow-sm">
                            </div>
                        </div>

                        {{-- KONTEN --}}
                        <div class="p-3 flex flex-col flex-1">
                            <h3 class="text-md font-bold text-[#172a39] mb-2 line-clamp-2 leading-snug">
                                {{ $event->name }}
                            </h3>

                            {{-- Info --}}
                            <div class="space-y-1.5 mb-3">
                                <div class="flex items-center gap-1.5 text-sm text-[#172a39]">
                                    <svg class="w-3.5 h-3.5 text-[#172a39]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ format_date($event->date_time, 'd M Y') }} • {{ format_time($event->date_time) }}</span>
                                </div>

                                <div class="flex items-center gap-1.5 text-sm text-[#172a39]">
                                    <svg class="w-3.5 h-3.5 text-[#172a39]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="truncate">{{ $event->location }}</span>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="mt-auto pt-2 border-t border-gray-100 flex justify-between items-center">
                                <div class="flex items-center gap-1.5 min-w-0 pr-2">
                                    <div class="w-5 h-5 rounded-full bg-indigo-50 flex items-center justify-center flex-shrink-0 text-sm text-oranye font-bold border border-indigo-100">
                                        {{ substr($event->user->name ?? 'O', 0, 1) }}
                                    </div>
                                    <span class="text-sm text-[#172a39] truncate font-medium max-w-[80px]">
                                        {{ $event->user->name ?? 'Organizer' }}
                                    </span>
                                </div>

                                <div class="text-right flex-shrink-0">
                                    <p class="text-md font-bold text-oranye">
                                        @if($minPrice == 0)
                                            Gratis
                                        @else
                                            {{ format_rupiah($minPrice) }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $favorites->links() }}
        </div>
    @else
        {{-- EMPTY STATE --}}
        <div class="text-center py-16 bg-beige rounded-xl">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900">Belum ada event favorit</h3>
            <p class="text-gray-500 mt-1">Simpan event menarik di sini agar mudah ditemukan nanti.</p>
            <a href="{{ route('events.explore') }}" class="mt-4 inline-block px-4 py-2 bg-oranye text-white rounded-lg text-sm font-medium hover:bg-[#e4482e]">
                Jelajahi Event
            </a>
        </div>
    @endif
</div>
