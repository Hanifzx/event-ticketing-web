<li class="relative group">

    {{-- CARD --}}
    <a href="{{ route('user.bookings.show', $booking->id) }}"
       wire:navigate
       class="block hover:bg-gray-50 transition duration-150 ease-in-out">
       
        <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <p class="text-sm font-bold text-deep-blue truncate">
                    {{ $booking->ticket->event->name }}
                </p>

                {{-- STATUS BADGE --}}
                @if($booking->status !== 'pending')
                    <span class=" py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                        {{ $booking->status === 'approved' ? 'text-oranye' : 'bg-red-100 text-red-800' }}">
                        {{ $booking->status === 'approved' ? 'Pembayaran Berhasil' : 'Pembayaran Gagal' }}  
                    </span>
                @endif
            </div>

            <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                    <p class="flex items-center text-sm text-gray-500">
                        Dibeli pada {{ $booking->created_at->format('d M Y') }}
                    </p>
                    <p class="mt-2 flex items-center text-sm text-gray-700 sm:mt-0 sm:ml-6">
                        {{ $booking->quantity }} Tiket ({{ $booking->ticket->name }})
                    </p>
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                    <p class="font-semibold text-gray-900">
                        {{ format_rupiah($booking->total_price) }}
                    </p>
                </div>
            </div>
        </div>
    </a>

    {{-- BUTTON BATALKAN --}}
    @if($booking->status === 'pending')
        <div class="absolute top-4 right-4 z-99">
            <x-confirm-button
                action="cancelBooking({{ $booking->id }})"
                title="Batalkan Pesanan?"
                message="Apakah Anda yakin ingin membatalkan pesanan ini?"
                confirmText="Ya, Batalkan"
                cancelText="Tidak"
                class="!text-xs !font-medium !text-[#ff0000] !bg-red-50 !hover:bg-red-100 
                !border !border-red-200 !px-3 !py-1 !rounded-full !transition"
            >
                Batalkan
            </x-confirm-button>
        </div>
    @endif

</li>