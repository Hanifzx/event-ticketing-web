<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
    {{-- Header Status --}}
    <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
        <div>
            <p class="text-sm text-gray-500">Order ID: #{{ $booking->id }}</p>
            <p class="text-sm text-gray-500">{{ $booking->created_at->format('d M Y, H:i') }}</p>
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
                <span class="text-gray-600">Jumlah</span>
                <span class="font-semibold">{{ $booking->quantity }} Tiket</span>
            </div>
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Harga Satuan</span>
                <span>Rp {{ number_format($booking->ticket->price, 0, ',', '.') }}</span>
            </div>
            <div class="border-t border-gray-200 mt-3 pt-3 flex justify-between items-center">
                <span class="text-lg font-bold text-gray-900">Total Bayar</span>
                <span class="text-xl font-bold text-indigo-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="p-6 bg-gray-50 border-t border-gray-200">
        @if($booking->status === 'pending')
            <p class="text-sm text-gray-600 mb-4 text-center">
                Silakan tunggu Organizer memverifikasi pesanan Anda. Anda bisa meninggalkan halaman ini.
            </p>
            <a href="{{ route('home') }}" wire:navigate class="block w-full text-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-gray-700 hover:bg-gray-50">
                Kembali ke Beranda
            </a>
        @elseif($booking->status === 'approved')
            <a href="{{ route('user.bookings.download', $booking->id) }}" 
               target="_blank"
               class="w-full px-4 py-3 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700 flex justify-center items-center transition duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Download E-Ticket (PDF)
            </a>
        @endif
    </div>
</div>