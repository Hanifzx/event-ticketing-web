<div class="relative min-h-screen">
    <div class="flex flex-col gap-6 mb-16">
        @for ($i = 1; $i <= $booking->quantity; $i++)
            @php
                // --- LOGIC ID TIKET VIRTUAL ---
                $urutan = str_pad($i, 2, '0', STR_PAD_LEFT);
                $hash = strtoupper(substr(md5($booking->id . $i . $booking->created_at->timestamp), 0, 5));
                $ticketId = "TKT-{$booking->id}-{$urutan}-{$hash}";
            @endphp

            {{-- Ticket Card --}}
            <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                {{-- Header Kartu --}}
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                    <div>   
                        <p class="text-xs font-bold text-oranye uppercase tracking-wide mb-1">Tiket #{{ $i }}</p>
                        <p class="text-xs text-gray-500">Order ID: #{{ $booking->id }} • {{ format_date($booking->created_at, 'd M Y, H:i') }}</p>
                    </div>
                    <div>
                        @if($booking->status === 'pending')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#e4482e]/10 text-oranye animate-pulse">
                                Menunggu Pembayaran
                            </span>
                        @elseif($booking->status === 'approved')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full text-oranye">
                                Telah dibayar
                            </span>
                        @elseif($booking->status === 'rejected')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Pembayaran Gagal
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Body Kartu --}}
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        
                        {{-- Bagian Kiri: Info Event --}}
                        <div class="flex-1">
                            <h2 class="text-xl font-bold text-gray-900">{{ $booking->ticket->event->name }}</h2>
                            <p class="text-gray-600 text-sm flex items-center mt-2 mb-4">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $booking->ticket->event->location }}
                            </p>

                            <div class="bg-indigo-50/50 rounded-lg border border-indigo-100 p-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase mb-1">Jenis Tiket</p>
                                        <p class="font-bold text-gray-900">{{ $booking->ticket->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase mb-1">Kode Unik</p>
                                        <p class="font-mono font-bold    tracking-wider text-sm">
                                            {{ $ticketId }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bagian Kanan: QR Code --}}
                        <div class="flex flex-col items-center justify-center border-l border-gray-100 pl-6 md:w-48">
                            @if($booking->status === 'approved')
                                {{-- Generate QR Code Langsung di View --}}
                                <div class="p-2 bg-white border border-gray-200 rounded-lg">
                                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($ticketId) !!}
                                </div>
                                <p class="text-[10px] text-gray-400 mt-2 text-center">Scan untuk Validasi</p>
                            @else
                                <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-xs text-center p-2">
                                    QR Code belum tersedia
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            {{-- END: Satu Kartu Tiket --}}
        @endfor
    </div>

    {{-- Action Button (Floating Footer) --}}
    <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-300 p-4 shadow-[0_-5px_15px_rgba(0,0,0,0.1)] z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="hidden md:block">
                <p class="text-sm text-gray-500">Total Pembayaran</p>
                <p class="text-xl font-bold text-oranye">{{ format_rupiah($booking->total_price) }}</p>
            </div>

            <div class="w-full md:w-auto">
                @if($booking->status === 'pending')
                    <a href="{{ route('home') }}" wire:navigate class="block w-full text-center px-6 py-3 bg-oranye border border-oranye rounded-md font-semibold text-sm text-white hover:bg-[#e4482e]">
                        Kembali ke Beranda
                    </a>
                @elseif($booking->status === 'approved')
                    <a href="{{ route('user.bookings.download', $booking->id) }}" target="_blank" class="flex items-center justify-center w-full px-6 py-3 bg-oranye text-white rounded-md font-semibold hover:bg-[#e4482e] transition shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download {{ $booking->quantity }} E-Ticket (.ZIP)
                    </a>
                @endif
            </div>
        </div>
    </div>

</div>