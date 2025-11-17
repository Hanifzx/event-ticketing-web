<div>
    <form wire:submit="save" class="space-y-6">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Nama Event')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Deskripsi')" />
            <textarea wire:model="description" id="description" name="description"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                rows="5"></textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="date_time" :value="__('Tanggal & Waktu')" />
            <x-text-input wire:model="date_time" id="date_time" class="block mt-1 w-full" type="datetime-local" name="date_time" required />
            <x-input-error :messages="$errors->get('date_time')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="location" :value="__('Lokasi')" />
            <x-text-input wire:model="location" id="location" class="block mt-1 w-full" type="text" name="location" required />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                Batal
            </a>
            
            <x-primary-button>
                {{ $event ? 'Perbarui Event' : 'Simpan Event' }}
            </x-primary-button>
        </div>
    </form>
</div>