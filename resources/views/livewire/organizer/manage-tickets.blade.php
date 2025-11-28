<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 1. HEADER PAGE --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[#172a39]">Manajemen Tiket</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Atur jenis dan harga tiket untuk event: 
                    <span class="font-bold text-[#fc563c]">{{ $event->name }}</span>
                </p>
            </div>
        </div>

        <x-flash-message />

        {{-- 2. FORM INPUT TIKET (CARD) --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 sm:p-8 mb-8">
            
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                <div class="w-10 h-10 rounded-full bg-beige flex items-center justify-center text-[#fc563c]">
                    @if($editingTicket)
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    @endif
                </div>
                <div>
                    <h4 class="text-lg font-bold text-[#172a39]">
                        {{ $editingTicket ? 'Edit Data Tiket' : 'Tambah Tiket Baru' }}
                    </h4>
                    <p class="text-xs text-gray-500">Isi detail tiket di bawah ini.</p>
                </div>
            </div>

            <form wire:submit="saveTicket">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Nama Tiket --}}
                    <div class="md:col-span-1">
                        <x-input-label for="name" :value="__('Jenis Tiket')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="name" id="name" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] transition-shadow shadow-sm placeholder-gray-400" 
                            type="text" 
                            placeholder="Contoh: Presale, VIP, Regular"
                            required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Harga --}}
                    <div class="md:col-span-1">
                        <x-input-label for="price" :value="__('Harga (Rp)')" class="text-gray-700 font-semibold" />
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-400 text-sm">Rp</span>
                            </div>
                            <x-text-input wire:model="price" id="price" 
                                class="block w-full pl-10 rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] transition-shadow shadow-sm" 
                                type="number" step="1000" min="0" required />
                        </div>
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    {{-- Kuota --}}
                    <div class="md:col-span-1">
                        <x-input-label for="quota" :value="__('Kuota Tiket')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="quota" id="quota" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] transition-shadow shadow-sm" 
                            type="number" min="1" required />
                        <x-input-error :messages="$errors->get('quota')" class="mt-2" />
                    </div>

                    {{-- Max Purchase --}}
                    <div class="md:col-span-1">
                        <x-input-label for="max_purchase_per_user" :value="__('Maks. Beli / User (Opsional)')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="max_purchase_per_user" id="max_purchase_per_user" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] transition-shadow shadow-sm placeholder-gray-400" 
                            type="number"
                            min="1"/>
                        <x-input-error :messages="$errors->get('max_purchase_per_user')" class="mt-2" />
                    </div>

                    {{-- Sale Start --}}
                    <div class="md:col-span-1">
                        <x-input-label for="sale_start_date" :value="__('Mulai Dijual (Opsional)')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="sale_start_date" id="sale_start_date" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] text-gray-600 shadow-sm" 
                            type="datetime-local" />
                        <x-input-error :messages="$errors->get('sale_start_date')" class="mt-2" />
                    </div>

                    {{-- Sale End --}}
                    <div class="md:col-span-1">
                        <x-input-label for="sale_end_date" :value="__('Selesai Dijual (Opsional)')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="sale_end_date" id="sale_end_date" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] text-gray-600 shadow-sm" 
                            type="datetime-local" />
                        <x-input-error :messages="$errors->get('sale_end_date')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 gap-4">
                    @if($editingTicket)
                        <button wire:click.prevent="resetForm" type="button" 
                                class="text-sm font-bold text-gray-500 hover:text-gray-800 transition-colors px-4 py-2">
                            Batal
                        </button>
                    @endif
                    
                    <x-primary-button class="bg-[#fc563c] hover:bg-[#e4482e] focus:ring-[#fc563c] px-6 py-3 rounded-xl shadow-lg shadow-orange-100">
                        {{ $editingTicket ? 'Simpan Perubahan' : 'Simpan Tiket' }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        {{-- 3. TABEL DAFTAR TIKET --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
            
            <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Daftar Tiket Aktif</h4>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-white">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jenis Tiket</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Harga</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Kuota</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Maks. Beli</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Terjual</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-50">
                        @forelse ($tickets as $ticket)
                        @php
                            $soldCount = $ticket->bookings->where('status', 'approved')->sum('quantity');
                        @endphp
                            <tr class="hover:bg-gray-50/80 transition-colors group">
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-gray-700">{{ $ticket->name }}</span>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ format_rupiah($ticket->price) }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-sm font-semibold text-gray-700">{{ $ticket->quota }}</span>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-xs font-semibold text-gray-700">{{ $ticket->max_purchase_per_user ?? '∞' }}</span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="text-xs font-semibold text-gray-700">
                                        {{ $soldCount }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        
                                        {{-- Edit Button --}}
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-[12px] text-center font-md text-gray-500">Edit</p>
                                            <button wire:click="editTicket({{ $ticket->id }})" 
                                                class="p-2 text-gray-400 border border-gray-200 rounded-lg hover:border-blue-500 hover:text-blue-500 transition-all"
                                                title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                        </div>

                                        {{-- Delete Button (Confirm) --}}
                                        <div class="flex flex-col items-center justify-center">
                                            <p class="text-[12px] text-center font-md text-gray-500 mb-1">Hapus</p>
                                            <x-confirm-button 
                                                action="deleteTicket({{ $ticket->id }})"
                                                title="Hapus Tiket?"
                                                message="Anda yakin ingin menghapus tiket {{ $ticket->name }}?"
                                                confirmText="Hapus"
                                                cancelText="Batal"
                                                class="!bg-transparent w-0 h-0 pt-3 !focus:ring-0">
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
                                <td colspan="5" class="px-6 py-16 text-center bg-white">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">Belum ada tiket</p>
                                        <p class="text-xs text-gray-500 mt-1">Gunakan form di atas untuk membuat tiket baru.</p>
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