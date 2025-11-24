<div>
    @teleport('#catalog-filter-target')
        <div class="mb-8">
            @include('livewire.partials.filter')
        </div>
    @endteleport

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" 
         wire:loading.class="opacity-50 pointer-events-none duration-200">
         
        @forelse($events as $event)
            @php
                // Ambil harga termurah
                $minPrice = $event->tickets->min('price') ?? 0;
            @endphp

            <a href="{{ route('event.show', $event->id) }}" 
               wire:key="event-{{ $event->id }}"
               class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full relative">
                
                <div class="relative aspect-[4/3] overflow-hidden">
                    <img src="{{ $event->image_path ? asset('storage/' . $event->image_path) : 'https://via.placeholder.com/400x300' }}" 
                         alt="{{ $event->name }}" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    
                    <div class="absolute top-4 left-4">
                        <span class="bg-white/95 backdrop-blur-md text-indigo-600 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm tracking-wide">
                            {{ $event->category }}
                        </span>
                    </div>
                </div>
                
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 line-clamp-2 leading-snug group-hover:text-indigo-600 transition-colors">
                        {{ $event->name }}
                    </h3>

                    <div class="space-y-3 mb-6">
                        
                        <div class="flex items-center text-sm text-gray-500">
                            <div class="w-8 flex-shrink-0 flex justify-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700 truncate">
                                {{ $event->user->name ?? 'Organizer' }}
                            </span>
                        </div>

                        <div class="flex items-center text-sm text-gray-500">
                            <div class="w-8 flex-shrink-0 flex justify-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="truncate">{{ $event->location }}</span>
                        </div>

                        <div class="flex items-center text-sm text-gray-500">
                            <div class="w-8 flex-shrink-0 flex justify-center">
                                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span>
                                {{ format_date($event->date_time, 'd M Y') }} • {{ format_time($event->date_time) }} WIB
                            </span>
                        </div>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-100 flex justify-end items-center">
                        <div class="text-right">
                            <p class="text-xs text-gray-400 font-medium mb-0.5">Mulai dari</p>
                            <p class="text-lg font-bold text-indigo-600">
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
        @empty
            <div class="col-span-full py-16 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Belum ada event</h3>
                <p class="mt-2 text-gray-500 max-w-sm mx-auto">
                    Coba ubah filter atau kata kunci pencarian Anda untuk menemukan event lainnya.
                </p>
            </div>
        @endforelse
    </div>
</div>