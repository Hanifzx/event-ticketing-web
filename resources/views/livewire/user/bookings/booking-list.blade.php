<div class="space-y-10 mb-14">
    <div class="mt-3">
        <h2 class="text-2xl font-bold text-deep-blue">Pesanan dan Riwayat Pembelian</h2>
    </div>
    {{-- BAGIAN 1: MENUNGGU KONFIRMASI --}}
    @if($pendingBookings->isNotEmpty())
        <section>
            <h3 class="text-lg font-semibold text-deep-blue mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Menunggu Pembayaran
            </h3>
            <div class="bg-white sm:rounded-lg overflow-hidden shadow-lg">
                <ul class="divide-y divide-gray-200">
                    @foreach($pendingBookings as $booking)
                        @include('livewire.user.bookings.partials.booking-item', ['booking' => $booking])
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    {{-- BAGIAN 2: RIWAYAT PEMESANAN --}}
    <section>
        <h3 class="text-lg font-semibold text-deep-blue mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            Riwayat Pembelian
        </h3>
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-200">
            <ul class="divide-y divide-gray-200">
                @forelse($historyBookings as $booking)
                    @include('livewire.user.bookings.partials.booking-item', ['booking' => $booking])
                @empty
                    <li class=" bg-beige border-none px-4 py-8 text-center text-gray-500">
                        Belum ada riwayat Pembelian tiket.
                    </li>
                @endforelse
            </ul>
        </div>
    </section>

</div>