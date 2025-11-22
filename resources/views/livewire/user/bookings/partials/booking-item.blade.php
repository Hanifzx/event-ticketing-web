<li class="relative group">
    
    <a href="{{ route('user.bookings.show', $booking->id) }}" wire:navigate class="block hover:bg-gray-50 transition duration-150 ease-in-out">
        <div class="px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-indigo-600 truncate pr-20">
                    {{ $booking->ticket->event->name }}
                </p>
                <div class="ml-2 flex-shrink-0 flex">
                    @if($booking->status === 'approved')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                    @elseif($booking->status === 'pending')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Dibatalkan</span>
                    @endif
                </div>
            </div>
            <div class="mt-2 sm:flex sm:justify-between">
                <div class="sm:flex">
                    <p class="flex items-center text-sm text-gray-500">
                        {{ $booking->created_at->format('d M Y') }}
                    </p>
                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                        {{ $booking->quantity }} Tiket ({{ $booking->ticket->name }})
                    </p>
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                    <p class="font-semibold text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </a>

    {{-- Tombol Batalkan (Hanya muncul jika Pending) --}}
    @if($booking->status === 'pending')
        <div class="absolute top-4 right-14">
            <button 
                wire:click="cancelBooking({{ $booking->id }})"
                wire:confirm="Apakah Anda yakin ingin membatalkan pesanan ini?"
                wire:loading.attr="disabled"
                class="text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 px-3 py-1 rounded-md transition z-10 relative"
            >
                Batalkan
            </button>
        </div>
    @endif

</li>