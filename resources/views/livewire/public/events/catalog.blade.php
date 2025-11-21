<div class="container mx-auto px-4 py-4">

    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($events as $event)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    
                    <a href="{{ route('event.show', $event) }}" wire:navigate>
                        
                        {{-- Gambar Event --}}
                        <img src="{{ $event->image_path ? asset('storage/' . $event->image_path) : 'https://via.placeholder.com/400x250.png?text=Event+Image' }}" 
                                alt="{{ $event->name }}" 
                                class_alias="w-full h-48 object-cover">
                        
                        <div class="p-6">
                            {{-- Nama Event --}}
                            <h3 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $event->name }}</h3>
                            
                            {{-- Tanggal & Waktu --}}
                            <p class="text-sm text-gray-600 mb-2">
                                📅 {{ \Carbon\Carbon::parse($event->date_time)->format('D, d M Y - H:i') }} WITA
                            </p>
                            
                            {{-- Lokasi --}}
                            <p class="text-sm text-gray-600 mb-4">
                                📍 {{ $event->location }}
                            </p>
                            
                            {{-- Nama Organizer --}}
                            <p class="text-sm font-semibold text-gray-700">
                                Diselenggarakan oleh: {{ $event->user->name }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16">
            <h2 class="text-2xl font-semibold text-gray-600">
                @if(empty($search))
                    Belum ada event yang tersedia saat ini.
                @else
                    Event dengan kata kunci '{{ $search }}' tidak ditemukan.
                @endif
            </h2>
        </div>
    @endif

</div>