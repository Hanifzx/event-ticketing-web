<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[#172a39]">Pesanan Masuk</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola persetujuan tiket dari pembeli event Anda.</p>
            </div>
        </div>

        <x-flash-message />

        {{-- 2. TABEL BOOKING --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pembeli</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Event & Tiket</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                
                                {{-- ID --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-mono text-gray-400">#{{ $booking->id }}</span>
                                </td>

                                {{-- Pembeli --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-[#172a39]">{{ $booking->user->name }}</span>
                                        <span class="text-xs text-gray-500">{{ $booking->user->email }}</span>
                                    </div>
                                </td>

                                {{-- Event & Tiket --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-[#172a39]">{{ $booking->ticket->event->name }}</span>
                                        <div class="flex items-center gap-1 text-xs text-gray-500 mt-0.5">
                                            <span class="px-1.5 py-0.5 rounded bg-gray-100 text-gray-600 font-medium">
                                                {{ $booking->ticket->name }}
                                            </span>
                                            <span>x {{ $booking->quantity }}</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Total --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm font-bold text-[#fc563c]">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($booking->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5 animate-pulse"></span>
                                            Menunggu
                                        </span>
                                    @elseif($booking->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                            Disetujui
                                        </span>
                                    @elseif($booking->status === 'cancelled')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500 border border-gray-200">
                                            Dibatalkan User
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if($booking->status === 'pending')
                                        <div class="flex items-center justify-end gap-2">
                                            
                                            {{-- Tombol Reject --}}
                                            <x-confirm-button 
                                                action="reject({{ $booking->id }})"
                                                title="Tolak Pesanan?"
                                                message="Apakah Anda yakin ingin menolak pesanan ini? Kuota tiket akan dikembalikan."
                                                confirmText="Tolak Pesanan"
                                                cancelText="Batal"
                                            >
                                                <button class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Tolak">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </x-confirm-button>

                                            {{-- Tombol Approve --}}
                                            <x-confirm-button 
                                                action="approve({{ $booking->id }})"
                                                title="Setujui Pesanan?"
                                                message="Pastikan pembayaran sudah diterima sebelum menyetujui pesanan ini."
                                                confirmText="Setujui"
                                                cancelText="Batal"
                                            >
                                                <button class="p-2 text-green-500 hover:text-green-700 hover:bg-green-50 rounded-lg transition-colors" title="Setujui">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </x-confirm-button>
                                            
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center bg-white">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">Belum ada pesanan masuk</p>
                                        <p class="text-xs text-gray-500 mt-1">Pesanan baru akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if($bookings->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $bookings->links() }}
                </div>
            @endif

        </div>
    </div>
</div>