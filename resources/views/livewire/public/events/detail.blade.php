<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 py-8">
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- KOLOM KIRI: Hero Image & Deskripsi --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- Gambar --}}
            <div class="bg-gray-100 rounded-2xl overflow-hidden relative group h-[300px] sm:h-[450px]">
                @if($event->image_path)
                    {{-- Layer 1: Background Blur --}}
                    <div class="absolute inset-0">
                        <img src="{{ asset('storage/' . $event->image_path) }}" 
                             class="w-full h-full object-cover blur-2xl opacity-50 scale-110">
                    </div>
                    
                    {{-- Layer 2: Main Image --}}
                    <div class="relative h-full w-full flex justify-center items-center z-10">
                        <img src="{{ asset('storage/' . $event->image_path) }}" 
                             alt="{{ $event->name }}" 
                             class="h-full w-auto object-contain">
                    </div>
                @else
                    <div class="flex items-center justify-center h-full text-gray-300 bg-gray-50">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- HEADER TEXT --}}
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-start gap-4">
                    {{-- Judul Event --}}
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">
                        {{ $event->name }}
                    </h1>
                    {{-- Tombol Favorite --}}
                    <livewire:public.events.favorite-button :event="$event" />
                </div>

                {{-- Organizer  --}}
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span>Oleh:</span>
                    <div class="flex items-center gap-1.5">
                        <span class="font-semibold text-gray-900">{{ $event->user->name }}</span>
                    </div>
                </div>
            </div>

            {{-- 3. INFO GRID (Waktu & Lokasi) --}}
            <div class="flex gap-10">
                
                {{-- Waktu --}}
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-1">Jadwal Event</h3>
                        <p class="text-sm text-gray-600">
                            {{ format_date($event->date_time, 'l, d F Y') }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Pukul {{ format_time($event->date_time) }} WIB
                        </p>
                    </div>
                </div>

                {{-- Lokasi --}}
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center text-red-600 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 mb-1">Lokasi</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $event->location }}
                        </p>
                    </div>
                </div>

            </div>

            <hr class="border-gray-100">

            {{-- 4. DESKRIPSI --}}
            <div>
                <h2 class="text-xl font-bold text-deep-blue mb-2">Tentang Event Ini</h2>
                
                <div class="prose prose-sm prose-gray max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            {{-- Kategori --}}
            <div>
                <span class="flex-shrink-0 bg-[#fc563c]/5 text-oranye text-xs font-bold px-2 py-1.5 uppercase tracking-wide leading-relaxed">
                    Kategori: {{ $event->category }}
                </span>
            </div>
        </div>

        {{-- KOLOM KANAN: Sticky Sidebar (Booking Card) --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 relative overflow-hidden">

                    <h3 class="text-lg font-bold text-gray-900 mb-1">Booking Tiket</h3>
                    <p class="text-sm text-gray-500 mb-6">Pilih tiketmu sekarang sebelum kehabisan.</p>

                    @if($cheapestTicket)
                        <div class="bg-gray-50 rounded-xl p-5 mb-6 border border-gray-100">
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Harga Mulai</p>
                            <div class="flex items-end gap-1">
                                <span class="text-3xl font-black text-gray-900 tracking-tight">
                                    {{ format_rupiah($cheapestTicket->price) }}
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <a href="{{ route('user.events.book.ticket', $event->id) }}" 
                                class="block w-3/4 bg-[#fc563c] hover:bg-[#e4482e] text-white text-center text-base font-bold py-3.5 px-6 rounded-xl transition-all duration-200 shadow-lg shadow-orange-200 hover:shadow-orange-300 transform hover:-translate-y-0.5">
                                Beli Tiket Sekarang
                            </a>
                        </div>
                    @else
                        <div class="bg-gray-50 rounded-xl p-8 text-center border border-dashed border-gray-300 mb-4">
                            <p class="text-sm font-medium text-gray-500">Tiket belum tersedia saat ini.</p>
                        </div>
                    @endif

                    {{-- Safety Badge --}}
                    <div class="mt-6 flex items-start gap-3 p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <div>
                            <p class="text-xs font-bold text-gray-700">Jaminan Transaksi Aman</p>
                            <p class="text-[10px] text-gray-500 mt-0.5 leading-snug">
                                Pembayaran Anda dilindungi sistem keamanan terenkripsi. Tiket digital dikirim instan.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>