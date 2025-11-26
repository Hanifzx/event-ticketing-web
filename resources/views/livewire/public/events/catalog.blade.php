<div>
    @teleport('#catalog-filter-target')
        <div class="mb-8">
            @include('livewire.partials.filter')
        </div>
    @endteleport

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" 
        wire:loading.class="opacity-50 pointer-events-none duration-200">

        @forelse($events as $event)
            @php
                $minPrice = $event->tickets->min('price') ?? 0;
                $imageUrl = $event->image_path ? asset('storage/' . $event->image_path) : 'https://via.placeholder.com/400x300';
            @endphp

            <a href="{{ route('event.show', $event->id) }}" 
                wire:key="event-{{ $event->id }}"
                class="block bg-beige border shadow-md border-gray-200 rounded-xl overflow-hidden h-full flex-col relative group">
                
                {{-- Container Gambar --}}
                <div class="relative h-48 w-full overflow-hidden bg-gray-100">
                    
                    {{-- Layer 1: Background Blur --}}
                    <div class="absolute inset-0">
                        <img src="{{ $imageUrl }}" 
                             alt="" 
                             class="w-full h-full object-cover blur-xl scale-110 opacity-50">
                    </div>

                    {{-- Layer 2: Gambar Utama --}}
                    <div class="relative h-full w-full flex justify-center items-center z-10">
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $event->name }}" 
                             class="h-full w-auto object-contain shadow-sm">
                    </div>
                    
                    {{-- Kategori --}}
                    {{-- <div class="absolute top-2 left-2 z-20">
                        <span class="bg-white/90 backdrop-blur text-oranye text-md font-bold px-2 py-0.5 rounded shadow-sm border border-white/50">
                            {{ $event->category }}
                        </span>
                    </div> --}}
                </div>
                
                {{-- konten --}}
                <div class="p-3 flex flex-col flex-1">
                    {{-- Judul --}}
                    <h3 class="text-md font-bold text-[#172a39] mb-2 line-clamp-2 leading-snug">
                        {{ $event->name }}
                    </h3>

                    <div class="space-y-1.5 mb-3">
                        {{-- Tanggal --}}
                        <div class="flex items-center gap-1.5 text-sm text-[#172a39]-800">
                            <svg class="w-3.5 h-3.5 text-[#172a39]-800 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>
                                {{ format_date($event->date_time, 'd M Y') }} • {{ format_time($event->date_time) }}
                            </span>
                        </div>
                        {{-- Lokasi --}}
                        <div class="flex items-center gap-1.5 text-sm text-[#172a39]-800">
                            <svg class="w-3.5 h-3.5 text-[#172a39]-800 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="truncate">{{ $event->location }}</span>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="mt-auto pt-2 border-t border-gray-100 flex justify-between items-center">
                        {{-- Organizer --}}
                        <div class="flex items-center gap-1.5 min-w-0 pr-2">
                            <div class="w-5 h-5 rounded-full bg-indigo-50 flex items-center justify-center flex-shrink-0 text-sm text-oranye font-bold border border-indigo-100">
                                {{ substr($event->user->name ?? 'O', 0, 1) }}
                            </div>
                            <span class="text-sm text-[#172a39]-800 truncate font-medium max-w-[80px]">
                                {{ $event->user->name ?? 'Organizer' }}
                            </span>
                        </div>

                        {{-- Harga --}}
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
        @empty
            <div class="col-span-full py-10 text-center border border-dashed border-gray-200 rounded-xl bg-gray-50/50">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 mb-2">
                    <svg class="w-5 h-5 text-[#172a39]-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-md font-semibold text-[#172a39]-800">Tidak ada event. Coba Refresh halaman.</h3>
            </div>
        @endforelse
    </div>
</div>