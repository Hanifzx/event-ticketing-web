<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-[#172a39]">Manajemen Event Global</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola, moderasi, dan pantau seluruh event di platform.</p>
            </div>

            {{-- Tombol Buat Event (Admin Official) --}}
            <a href="{{ route('organizer.events.create') }}" class="inline-flex items-center px-5 py-2.5 bg-[#fc563c] hover:bg-[#e4482e] text-white text-sm font-bold rounded-xl shadow-lg shadow-orange-200 transition-all duration-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Event Official
            </a>
        </div>

        <x-flash-message />

        {{-- 2. TABEL EVENT --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Event Info</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Organizer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jadwal & Lokasi</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse ($events as $event)
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                
                                {{-- Kolom 1: Gambar & Nama --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-12 w-16 flex-shrink-0 overflow-hidden rounded-lg border border-gray-200 bg-gray-100 relative">
                                            @if($event->image_path)
                                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $event->image_path) }}" alt="">
                                            @else
                                                <div class="flex h-full w-full items-center justify-center text-gray-400">
                                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-[#172a39]">{{ $event->name }}</div>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-indigo-50 text-indigo-700 border border-indigo-100 mt-1">
                                                {{ $event->category }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom 2: Organizer --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-700">{{ $event->user->name ?? 'Unknown' }}</span>
                                            <span class="text-xs text-gray-500">{{ $event->user->email ?? '' }}</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom 3: Tanggal --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center text-sm text-gray-700">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ format_date($event->date_time) }}
                                        </div>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400 whitespace-normal break-words" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ Str::limit($event->location, 40) }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom 4: Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        
                                        {{-- Lihat Tiket --}}
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-[12px] text-center font-md text-gray-500 mb-1">Tiket</p>
                                            <a href="{{ route('organizer.events.tickets.index', $event) }}" class="p-2 text-oranye rounded-lg border hover:bg-orange-50 transition-colors" title="Lihat Tiket">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                            </a>
                                        </div>

                                        {{-- Edit Event --}}
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-[12px] text-center font-md text-gray-500 mb-1">Edit</p>
                                            <a href="{{ route('organizer.events.edit', $event) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg border transition-colors" title="Edit Event">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                        </div>

                                        {{-- Hapus (Moderasi) --}}
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-[12px] text-center font-md text-gray-500 mb-1">Hapus</p>
                                            <x-confirm-button 
                                                action="delete({{ $event->id }})"
                                                title="Hapus Event?"
                                                message="Anda yakin ingin menghapus event '{{ $event->name }}' milik {{ $event->user->name }}? Tindakan ini permanen."
                                                confirmText="Hapus"
                                                cancelText="Batal"
                                                class="!bg-transparent !p-0 !w-auto !h-auto !shadow-none !hover:bg-transparent"
                                            >
                                                <div class="p-2 text-gray-400 hover:text-red-600 border rounded-lg hover:border-red-600 transition-colors cursor-pointer" title="Hapus (Moderasi)">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </div>
                                            </x-confirm-button>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center bg-white">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">Tidak ada event ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            @if($events->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $events->links() }}
                </div>
            @endif

        </div>
    </div>
</div>