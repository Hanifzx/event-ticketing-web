<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
        {{-- Bagian Header Gambar & Judul --}}
        <div class="relative h-64 sm:h-96 bg-gray-200">
            @if($event->image_path)
                <img src="{{ asset('storage/' . $event->image_path) }}" alt="{{ $event->name }}" class="w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center h-full text-gray-400">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            @endif
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                <h1 class="text-3xl font-bold text-white">{{ $event->name }}</h1>
                <p class="text-white flex items-center mt-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $event->location }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-6">
            {{-- Kolom Kiri: Deskripsi --}}
            <div class="md:col-span-2 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Tentang Acara</h2>
                    <div class="prose max-w-none text-gray-600">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>
                
                <div class="flex items-center text-gray-600 mt-4">
                     <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                     {{ format_date($event->date_time) }} • {{ format_time($event->date_time) }} WITA
                </div>
                
                <div class="flex items-center mt-2">
                    <div class="text-sm text-gray-500">
                        Diselenggarakan oleh: <span class="font-semibold text-indigo-600">{{ $event->user->name }}</span>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Daftar Tiket --}}
            <div class="md:col-span-1">
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 sticky top-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Beli Tiket</h3>

                    @if($cheapestTicket)
                        <div class="bg-white p-4 rounded-md shadow-sm border border-gray-200">
                            <p class="text-sm text-gray-600 mb-2">Mulai dari</p>

                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xl font-bold text-indigo-600">
                                    {{ format_rupiah($cheapestTicket->price) }}
                                </span>
                            </div>

                            <a href="{{ route('user.events.book.ticket', $event->id) }}"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded transition">
                                Pesan Sekarang
                            </a>
                        </div>
                    @else
                        <p class="text-gray-500 text-sm text-center py-4">
                            Belum ada tiket tersedia untuk acara ini.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>