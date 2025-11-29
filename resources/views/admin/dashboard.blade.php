<x-dashboard-layout title="Dashboard Admin | Olinevent">
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- 1. HEADER --}}
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-[#172a39]">Dashboard Overview</h2>
                <p class="text-sm text-gray-500 mt-1">Ringkasan performa platform dan aktivitas terbaru.</p>
            </div>

            {{-- ALERT: PENDING ORGANIZER --}}
            @if($pendingOrganizers > 0)
                <div class="mb-8 bg-orange-50 border border-orange-200 rounded-xl p-4 flex items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-orange-100 text-orange-600 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-[#172a39]">Butuh Persetujuan</h3>
                            <p class="text-xs text-gray-600">Ada <span class="font-bold text-[#fc563c]">{{ $pendingOrganizers }}</span> pendaftar organizer baru yang menunggu verifikasi Anda.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-white bg-[#fc563c] hover:bg-[#e4482e] px-4 py-2 rounded-lg transition-colors whitespace-nowrap">
                        Review Sekarang
                    </a>
                </div>
            @endif

            {{-- 2. STATS GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                {{-- Card 1: Total Revenue --}}
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Pendapatan</h3>
                        <div class="p-2 bg-green-50 text-green-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-2">
                        <span class="text-2xl font-bold text-[#172a39]">{{ format_rupiah($totalRevenue) }}</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Akumulasi dari tiket "approved"</p>
                </div>

                {{-- Card 2: Tiket Terjual --}}
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Tiket Terjual</h3>
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-2">
                        <span class="text-2xl font-bold text-[#172a39]">{{ number_format($ticketsSold) }}</span>
                        <span class="text-sm font-medium text-gray-400 mb-1">tiket</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Total tiket berhasil dibayar</p>
                </div>

                {{-- Card 3: Event Aktif --}}
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Event Aktif</h3>
                        <div class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-2">
                        <span class="text-2xl font-bold text-[#172a39]">{{ $activeEvents }}</span>
                        <span class="text-sm font-medium text-gray-400 mb-1">acara</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Event mendatang & sedang berlangsung</p>
                </div>

                {{-- Card 4: Total Organizer --}}
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Total Organizer</h3>
                        <div class="p-2 bg-orange-50 text-orange-600 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-2">
                        <span class="text-2xl font-bold text-[#172a39]">{{ $totalOrganizers }}</span>
                        <span class="text-sm font-medium text-gray-400 mb-1">mitra</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">{{ $pendingOrganizers }} menunggu persetujuan</p>
                </div>

            </div>

            {{-- 3. RECENT TRANSACTIONS --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h3 class="text-base font-bold text-[#172a39]">Transaksi Terbaru</h3>
                    <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-[#fc563c] hover:text-[#e4482e] hover:underline">
                        Lihat Semua
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Pembeli</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-400 uppercase tracking-wider">Event</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-400 uppercase tracking-wider">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-50">
                            @forelse ($recentBookings as $booking)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm font-bold text-[#172a39]">{{ $booking->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $booking->ticket->event->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-[#fc563c]">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($booking->status === 'approved')
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-700 border border-green-100">Sukses</span>
                                        @elseif($booking->status === 'pending')
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-yellow-50 text-yellow-700 border border-yellow-100">Pending</span>
                                        @elseif($booking->status === 'cancelled')
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-gray-100 text-gray-500 border border-gray-200">Batal</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-100">Gagal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs text-gray-400">
                                        {{ $booking->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada transaksi terbaru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-dashboard-layout>