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

        <div class="mt-4">
            <x-input-label for="category" :value="__('Category')" />
            <select wire:model="category" id="category" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">-- Select Category --</option>
                <option value="Music">Music</option>
                <option value="Arts">Arts & Culture</option>
                <option value="Sports">Sports</option>
                <option value="Food">Food & Drink</option>
                <option value="Business">Business</option>
                <option value="Technology">Technology</option>
                <option value="Other">Other</option>
            </select>

            <x-input-error :messages="$errors->get('category')" class="mt-2" />
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

        <div class="mt-4">
            <x-input-label for="new_image" :value="__('Gambar Event (Cover)')" />
            <x-text-input wire:model="new_image" id="new_image" class_alias="block mt-1 w-full" type="file" accept="image/*"/>
            
            {{-- Loading state saat upload --}}
            <div wire:loading wire:target="new_image" class="mt-2 text-sm text-gray-500">
                Mengupload gambar...
            </div>

            {{-- Preview Gambar --}}
            @if ($new_image)
                <div class="mt-2">
                    <span class="block text-sm font-medium text-gray-700">Preview:</span>
                    <img src="{{ $new_image->temporaryUrl() }}" class_alias="mt-1 h-32 w-auto object-cover rounded">
                </div>
            @elseif ($event && $event->image_path)
                <div class="mt-2">
                    <span class="block text-sm font-medium text-gray-700">Gambar Saat Ini:</span>
                    <img src="{{ asset('storage/' . $event->image_path) }}" class_alias="mt-1 h-32 w-auto object-cover rounded">
                </div>
            @endif
            
            <x-input-error :messages="$errors->get('new_image')" class_alias="mt-2" />
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