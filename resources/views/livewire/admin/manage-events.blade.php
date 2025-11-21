<div>
    @if (session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Event</th>
                
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Organizer</th>
                
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($events as $event)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $event->name }}</td>
                    
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $event->user->name ?? 'N/A' }}</td>
                    
                    <td class="px-6 py-4 text-sm text-gray-500"> {{ format_date($event->date_time) }}</td>

                    <td class="px-6 py-4 text-right text-sm font-medium">
                        
                        <button wire:click="delete({{ $event->id }})" 
                                wire:confirm="Anda yakin ingin menghapus event '{{ $event->name }}'?"
                                class="text-red-600 hover:text-red-900">
                            Hapus
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-sm text-gray-500 text-center">Belum ada event yang dibuat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>