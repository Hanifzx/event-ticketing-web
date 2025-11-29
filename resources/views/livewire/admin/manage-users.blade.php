<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-[#172a39]">Manajemen Pengguna</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola akses pengguna, verifikasi organizer, dan admin.</p>
            </div>

            {{-- Tab Filter --}}
            <div class="bg-white p-1 rounded-xl border border-gray-200 flex items-center shadow-sm">
                <button wire:click="setTab('all')" 
                        class="px-4 py-2 text-sm font-bold rounded-lg transition-all {{ $activeTab === 'all' ? 'bg-[#172a39] text-white shadow' : 'text-gray-500 hover:text-[#fc563c]' }}">
                    Semua Pengguna
                </button>
                <button wire:click="setTab('pending')" 
                        class="px-4 py-2 text-sm font-bold rounded-lg transition-all flex items-center gap-2 {{ $activeTab === 'pending' ? 'bg-[#fc563c] text-white shadow' : 'text-gray-500 hover:text-[#fc563c]' }}">
                    <span>Butuh Persetujuan</span>
                    @if($pendingCount > 0)
                        <span class="bg-white text-[#fc563c] text-[10px] px-1.5 py-0.5 rounded-full shadow-sm animate-pulse">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </button>
            </div>
        </div>

        <x-flash-message />

        {{-- 2. TABEL PENGGUNA --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="pl-10 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">User Info</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                
                                {{-- User Info --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-[#172a39]">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Role --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-bold text-blue-700">
                                            Admin
                                        </span>
                                    @elseif($user->role === 'organizer')
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-bold text-oranye">
                                            Organizer
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium text-gray-600">
                                            User
                                        </span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($user->role === 'organizer')
                                        @if($user->status === 'approved')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-100">
                                                Aktif
                                            </span>
                                        @elseif($user->status === 'pending')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-100 animate-pulse">
                                                Butuh Persetujuan
                                            </span>
                                        @elseif($user->status === 'rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-100">
                                                Ditolak
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-3 py-1 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">
                                        
                                        @if($user->is(Auth::user()))
                                            <span class="text-xs text-center text-gray-500 italic">(Akun Anda)</span>
                                        @else
                                            
                                        {{-- APPROVAL ORGANIZER --}}
                                        @if($user->role === 'organizer' && ($user->status === 'pending' || $user->status === 'rejected'))
                                            {{-- Tombol Reject --}}
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="text-[12px] text-center font-md text-gray-500 mb-1">Tolak</p>
                                                <x-confirm-button 
                                                    action="reject({{ $user->id }})"
                                                    title="Tolak Organizer?"
                                                    message="Organizer ini tidak akan bisa membuat event."
                                                    confirmText="Tolak"
                                                    cancelText="Batal"
                                                    class="!bg-transparent !p-0 !w-auto !h-auto !shadow-none !hover:bg-transparent !focus:ring-0"
                                                >
                                                    <div class="p-2 text-red-500 bg-red-50 hover:bg-red-100 border border-red-100 rounded-lg transition-colors cursor-pointer" title="Tolak">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    </div>
                                                </x-confirm-button>
                                            </div>

                                            {{-- Tombol Approve --}}
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="text-[12px] text-center font-md text-gray-500 mb-1">Terima</p>
                                                <x-confirm-button 
                                                    action="approve({{ $user->id }})"
                                                    title="Setujui Organizer?"
                                                    message="User ini akan diizinkan membuat event."
                                                    confirmText="Setujui"
                                                    class="!bg-transparent !p-0 !w-auto !h-auto !shadow-none !hover:bg-transparent !focus:ring-0"
                                                >
                                                    <div class="p-2 text-green-600 bg-green-50 hover:bg-green-100 border border-green-100 rounded-lg transition-colors cursor-pointer" title="Setujui">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    </div>
                                                </x-confirm-button>
                                            </div>
                                        @endif

                                        {{-- REJECT ONLY (Jika sudah Approved tapi ingin diblokir) --}}
                                        @if($user->role === 'organizer' && $user->status === 'approved')
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="text-[12px] text-center font-md text-gray-500 mb-1">Nonaktifkan</p>
                                                <x-confirm-button 
                                                    action="reject({{ $user->id }})"
                                                    title="Nonaktifkan Organizer?"
                                                    message="User ini akan kehilangan akses membuat event."
                                                    confirmText="Nonaktifkan"
                                                    class="!bg-transparent !p-0 !w-auto !h-auto !shadow-none !hover:bg-transparent !focus:ring-0"
                                                >
                                                    <div class="p-2 text-red-600 bg-red-50 border hover:border-red-600 rounded-lg transition-colors cursor-pointer" title="Nonaktifkan">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                                    </div>
                                                </x-confirm-button>
                                            </div>
                                        @endif

                                        {{-- PROMOTE USER TO ADMIN --}}
                                        @if($user->role === 'user')
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="text-[12px] text-center font-md text-gray-500 mb-1">Promosi Admin</p>
                                                <x-confirm-button 
                                                    action="promoteToAdmin({{ $user->id }})"
                                                    title="Promosikan User?"
                                                    message="Jadikan {{ $user->name }} sebagai Admin? Akses penuh akan diberikan."
                                                    confirmText="Ya, Promosikan"
                                                    class="!bg-transparent !p-0 !w-auto !h-auto !shadow-none !hover:bg-transparent !focus:ring-0"
                                                >
                                                    <div class="p-2 text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 border border-blue-100 rounded-lg transition-colors cursor-pointer" 
                                                        title="Jadikan Admin">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                        </svg>
                                                    </div>
                                                </x-confirm-button>
                                            </div>
                                        @endif

                                            {{-- HAPUS USER (General) --}}
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="text-[12px] text-center font-md text-gray-500 mb-1">Hapus</p>
                                                <x-confirm-button 
                                                    action="deleteUser({{ $user->id }})"
                                                    title="Hapus Pengguna?"
                                                    message="Hapus akun {{ $user->name }} secara permanen?"
                                                    confirmText="Hapus"
                                                    cancelText="Batal"
                                                    class="!bg-transparent !p-0 !w-auto !h-auto !shadow-none !hover:bg-transparent !focus:ring-0 ml-2"
                                                >
                                                    <div class="p-2 text-gray-400 hover:text-red-600 border hover:border-red-600 rounded-lg transition-colors cursor-pointer" title="Hapus User">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </div>
                                                </x-confirm-button>
                                            </div>

                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center bg-white">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">Tidak ada data ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>