<div class="relative min-h-screen pb-32"> {{-- ROOT ELEMENT PEMBUNGKUS UTAMA --}}
    
    {{-- Container Tiket dengan Jarak (Gap) --}}
    <div class="flex flex-col gap-6">
        @for ($i = 1; $i <= $booking->quantity; $i++)
            @php
                // --- LOGIC ID TIKET VIRTUAL ---
                $urutan = str_pad($i, 2, '0', STR_PAD_LEFT);
                $hash = strtoupper(substr(md5($booking->id . $i . $booking->created_at->timestamp), 0, 5));
                $ticketId = "TKT-{$booking->id}-{$urutan}-{$hash}";
            @endphp

            {{-- Ticket Card --}}
            <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                    <div>
                        <p class="text-sm text-gray-500">Order ID: #{{ $booking->id }}</p>
                        <p class="text-sm text-gray-500">{{ format_date($booking->created_at, 'd M Y, H:i') }}</p>
                    </div>
                    <div>
                        @if($booking->status === 'pending')
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 animate-pulse">
                                Menunggu Konfirmasi
                            </span>
                        @elseif($booking->status === 'approved')
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Approved (Siap Digunakan)
                            </span>
                        @elseif($booking->status === 'rejected')
                            <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Dibatalkan
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Detail Event & Tiket --}}
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $booking->ticket->event->name }}</h2>
                    <p class="text-gray-600 mb-6 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $booking->ticket->event->location }}
                    </p>

                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Jenis Tiket</span>
                            <span class="font-semibold">{{ $booking->ticket->name }}</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">ID Unik Tiket</span>
                            <span class="font-mono font-bold text-indigo-600 tracking-wider bg-indigo-50 px-2 rounded">
                                {{ $ticketId }}
                            </span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Harga Satuan</span>
                            <span>{{ format_rupiah($booking->ticket->price) }}</span>
                        </div>
                        {{-- Total Bayar hanya perlu ditampilkan sekali (opsional per card) atau cukup di footer --}}
                    </div>
                </div>
            </div>
        @endfor
    </div>

    {{-- Action Button (Floating Footer) --}}
    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-300 p-4 shadow-[0_-5px_15px_rgba(0,0,0,0.1)] z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            
            {{-- Info Total (Agar user ingat total bayar) --}}
            <div class="hidden md:block">
                <p class="text-sm text-gray-500">Total Pembayaran</p>
                <p class="text-xl font-bold text-indigo-600">{{ format_rupiah($booking->total_price) }}</p>
            </div>

            <div class="w-full md:w-auto">
                @if($booking->status === 'pending')
                    <a href="{{ route('home') }}" wire:navigate class="block w-full text-center px-6 py-3 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50">
                        Kembali ke Beranda
                    </a>
                @elseif($booking->status === 'approved')
                    <a href="{{ route('user.bookings.download', $booking->id) }}" target="_blank" class="flex items-center justify-center w-full px-6 py-3 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 transition shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download {{ $booking->quantity }} E-Ticket (.ZIP)
                    </a>
                @endif
            </div>
        </div>
    </div>

</div> {{-- END ROOT ELEMENT --}}