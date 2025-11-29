<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-[#172a39]">Laporan Penjualan</h2>
                <p class="text-sm text-gray-500 mt-1">Pantau seluruh transaksi tiket yang masuk ke dalam sistem.</p>
            </div>

            {{-- FILTER TABS --}}
            <div class="bg-white p-1 rounded-xl border border-gray-200 flex flex-wrap items-center shadow-sm gap-1">
                @foreach(['all' => 'Semua', 'pending' => 'Menunggu', 'approved' => 'Berhasil', 'rejected' => 'Gagal', 'cancelled' => 'Batal'] as $key => $label)
                    <button wire:click="setTab('{{ $key }}')" 
                            class="px-3 py-1.5 text-xs font-bold rounded-lg transition-all flex items-center gap-2
                            {{ $activeTab === $key ? 'bg-[#172a39] text-white shadow-md' : 'text-gray-500 hover:text-[#fc563c] hover:bg-gray-50' }}">
                        {{ $label }}
                        
                        {{-- Badge khusus untuk Pending --}}
                        @if($key === 'pending' && $pendingCount > 0)
                            <span class="bg-[#fc563c] text-white text-[9px] px-1.5 py-0.5 rounded-full {{ $activeTab === 'pending' ? 'bg-white text-oranye' : '' }}">
                                {{ $pendingCount }}
                            </span>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        {{-- 2. TABEL TRANSAKSI --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID & Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pembeli</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Event & Tiket</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Organizer</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                
                                {{-- ID & Tanggal --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-mono font-bold text-gray-600">#{{ $booking->id }}</span>
                                        <span class="text-xs text-gray-400">{{ $booking->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                </td>

                                {{-- Pembeli --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-bold text-[#172a39]">{{ $booking->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Event & Tiket --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col max-w-xs">
                                        <span class="text-sm font-bold text-[#172a39] truncate">{{ $booking->ticket->event->name ?? 'Event Dihapus' }}</span>
                                        <span class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                            <span class="bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200 text-gray-600 font-medium">
                                                {{ $booking->ticket->name ?? 'Tiket Dihapus' }}
                                            </span>
                                            x {{ $booking->quantity }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Organizer (Pemilik Event) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($booking->ticket->event->user)
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-semibold text-oranye px-2 py-1">
                                                {{ $booking->ticket->event->user->name }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-400 italic">N/A</span>
                                    @endif
                                </td>

                                {{-- Total --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm font-bold text-oranye">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($booking->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                            Berhasil
                                        </span>
                                    @elseif($booking->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-100 animate-pulse">
                                            Menunggu
                                        </span>
                                    @elseif($booking->status === 'cancelled')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                            Dibatalkan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-100">
                                            Gagal/Ditolak
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center bg-white">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">Belum ada data transaksi</p>
                                        <p class="text-xs text-gray-500 mt-1">Pilih filter lain atau tunggu pesanan masuk.</p>
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