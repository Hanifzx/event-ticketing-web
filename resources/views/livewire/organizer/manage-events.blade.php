<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- HEADER PAGE --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[#172a39]">Dashboard Event</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola jadwal, tiket, dan pantau penjualan event Anda.</p>
            </div>
            
            <a href="{{ route('organizer.events.create') }}" class="inline-flex items-center px-5 py-2.5 bg-oranye hover:bg-[#e4482e] text-white text-sm font-bold rounded-xl shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Event Baru
            </a>
        </div>

        <x-flash-message />

        {{-- TABLE CONTAINER --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    
                    {{-- TABLE HEAD --}}
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Informasi Event</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Statistik Penjualan</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status Tiket</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Kelola Event</th>
                        </tr>
                    </thead>

                    {{-- TABLE BODY --}}
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($events as $event)
                            @php
                                // Logic Statistik
                                $totalQuota = $event->tickets->sum('quota');
                                $soldCount = $event->tickets->sum(fn($t) => $t->bookings->where('status', 'approved')->sum('quantity'));
                                $pendingCount = $event->tickets->sum(fn($t) => $t->bookings->where('status', 'pending')->sum('quantity'));
                                $cancelledCount = $event->tickets->sum(fn($t) => $t->bookings->where('status', 'cancelled')->sum('quantity'));
                            @endphp

                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                
                                {{-- KOLOM 1: Info Event --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-14 w-20 flex-shrink-0 overflow-hidden rounded-lg border border-gray-200 bg-gray-100">
                                            @if($event->image_path)
                                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $event->image_path) }}" alt="">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center text-gray-400">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-[#172a39]">{{ $event->name }}</div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-mediu text-oranye">
                                                    {{ $event->category }}
                                                </span>
                                                <span class="text-xs text-gray-500 flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    {{ format_date($event->date_time) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- KOLOM 2: Statistik Angka --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <div class="text-center">
                                            <span class="block text-lg font-bold text-green-800">{{ $soldCount }}</span>
                                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wide">Terjual</span>
                                        </div>
                                        <div class="w-px h-8 bg-gray-200"></div>
                                        <div class="text-center">
                                            <span class="block text-lg font-bold text-yellow-800">{{ $pendingCount }}</span>
                                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wide">Pending</span>
                                        </div>
                                        <div class="w-px h-8 bg-gray-200"></div>
                                        <div class="text-center">
                                            <span class="block text-lg font-bold text-red-800">{{ $cancelledCount }}</span>
                                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wide">Batal</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- KOLOM 3: Sisa Tiket --}}
                                <td class="px-6 py-4 text-center">
                                    @if($totalQuota > 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-green-700">
                                            <span class="w-2 h-2 rounded-full mr-2 animate-pulse"></span>
                                            Tersedia: {{ $totalQuota }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-red-700">
                                            Habis Terjual
                                        </span>
                                    @endif
                                </td>

                                {{-- KOLOM 4: Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        
                                        {{-- Tombol Manage Ticket --}}
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-[12px] text-center font-md text-gray-500">Tiket</p>
                                            <a href="{{ route('organizer.events.tickets.index', $event) }}" 
                                               class="p-2 text-gray-500 bg-white border border-gray-200 rounded-lg hover:border-[#fc563c] hover:text-[#fc563c] transition-all duration-200" 
                                               title="Kelola Tiket">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                            </a>
                                        </div>

                                        {{-- Tombol Edit --}}
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-[12px] text-center font-md text-gray-500">Edit</p>
                                            <a href="{{ route('organizer.events.edit', $event) }}" 
                                               class="p-2 text-gray-500 bg-white border border-gray-200 rounded-lg hover:border-blue-500 hover:text-blue-600 transition-all duration-200" 
                                               title="Edit Event">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                        </div>

                                        {{-- Tombol Hapus --}}
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-[12px] text-center font-md text-gray-500 mb-1">Hapus</p>
                                            <x-confirm-button 
                                                action="delete({{ $event->id }})"
                                                title="Hapus Event?"
                                                message="Yakin hapus event {{ $event->name }}? Data tidak bisa dikembalikan."
                                                confirmText="Hapus"
                                                cancelText="Batal"
                                                class="!bg-transparent w-0 h-0 pt-3 !focus:ring-0"
                                            >
                                                <div class="p-2 text-red-600 !bg-white border rounded-lg hover:border-red-500 hover:text-red-400 focus:ring-0 transition-all duration-200 cursor-pointer" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </div>
                                            </x-confirm-button>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center text-gray-500 bg-white">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                        </div>
                                        <p class="text-base font-medium text-gray-900">Belum ada event</p>
                                        <p class="text-sm text-gray-400 mt-1 max-w-xs">Buat event pertamamu sekarang dan mulai jual tiket secara online.</p>
                                        <a href="{{ route('organizer.events.create') }}" class="mt-4 text-sm font-bold text-[#fc563c] hover:underline">
                                            + Buat Event Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION (Jika diperlukan nanti tinggal uncomment) --}}
        {{-- <div class="mt-4">
            {{ $events->links() }}
        </div> --}}
    </div>
</div>