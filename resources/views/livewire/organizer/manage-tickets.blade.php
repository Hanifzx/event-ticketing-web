<div>
    <hr class="my-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">
        Manajemen Tiket
    </h3>

    @if (session()->has('success_ticket'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success_ticket') }}
        </div>
    @endif

    <form wire:submit="saveTicket" class="bg-gray-50 p-6 rounded-lg shadow-sm mb-6">
        <h4 class="text-md font-semibold mb-3">{{ $editingTicket ? 'Edit Tiket' : 'Tambah Tiket Baru' }}</h4>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <x-input-label for="name" :value="__('Jenis Tiket (mis: VIP, Reguler)')" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="price" :value="__('Harga (Rp)')" />
                <x-text-input wire:model="price" id="price" class="block mt-1 w-full" type="number" step="1000" min="0" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="quota" :value="__('Kuota Tiket')" />
                <x-text-input wire:model="quota" id="quota" class="block mt-1 w-full" type="number" min="1" required />
                <x-input-error :messages="$errors->get('quota')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="max_purchase_per_user" :value="__('Maks Beli / User (Opsional)')" />
                <x-text-input wire:model="max_purchase_per_user" id="max_purchase_per_user" class="block mt-1 w-full" type="number" min="1" />
                <x-input-error :messages="$errors->get('max_purchase_per_user')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="sale_start_date" :value="__('Mulai Dijual (Opsional)')" />
                <x-text-input wire:model="sale_start_date" id="sale_start_date" class="block mt-1 w-full" type="datetime-local" />
                <x-input-error :messages="$errors->get('sale_start_date')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="sale_end_date" :value="__('Selesai Dijual (Opsional)')" />
                <x-text-input wire:model="sale_end_date" id="sale_end_date" class="block mt-1 w-full" type="datetime-local" />
                <x-input-error :messages="$errors->get('sale_end_date')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4 gap-4">
            @if($editingTicket)
                <x-secondary-button wire:click.prevent="resetForm">
                    Batal Edit
                </x-secondary-button>
            @endif
            <x-primary-button>
                {{ $editingTicket ? 'Perbarui Tiket' : 'Simpan Tiket' }}
            </x-primary-button>
        </div>
    </form>
    <h4 class="text-md font-semibold mb-3">Daftar Tiket Saat Ini</h4>
    <div class="overflow-x-auto bg-white shadow-sm sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Tiket</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuota</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Maks Beli</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($tickets as $ticket)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $ticket->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ticket->quota }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ticket->max_purchase_per_user ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="editTicket({{ $ticket->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                Edit
                            </button>
                            <button wire:click="deleteTicket({{ $ticket->id }})" 
                                    wire:confirm="Anda yakin ingin menghapus tiket '{{ $ticket->name }}'?"
                                    class="text-red-600 hover:text-red-900">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            Event ini belum memiliki tiket.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>