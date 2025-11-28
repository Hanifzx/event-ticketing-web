<div class="py-8">
    <div class="px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="">
            <h2 class="text-2xl font-bold text-[#172a39]">
                {{ $event ? 'Edit Event' : 'Buat Event Baru' }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                @if($event)
                Perbarui informasi untuk event <span class="font-bold text-[#fc563c]">{{ $event->name }}</span>
                @else
                Lengkapi detail event Anda untuk menarik peserta.
                @endif
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-beige rounded-2xl">
            
            <form wire:submit="save" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Nama Event (Full Width) --}}
                    <div class="md:col-span-2">
                        <x-input-label for="name" :value="__('Nama Event')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="name" id="name" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] transition-shadow shadow-sm placeholder:text-gray-400" 
                            type="text" 
                            name="name" 
                            placeholder="Masukkan nama event Anda"
                            required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <x-input-label for="category" :value="__('Kategori')" class="text-gray-700 font-semibold" />
                        <div class="relative mt-2">
                            <select wire:model="category" id="category" 
                                class="block w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] shadow-sm appearance-none bg-white py-2.5 pl-3 pr-10 text-gray-700 cursor-pointer transition-colors">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                            </select>
                            {{-- Custom Arrow Icon --}}
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    {{-- Tanggal & Waktu --}}
                    <div>
                        <x-input-label for="date_time" :value="__('Tanggal & Waktu')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="date_time" id="date_time" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] shadow-sm text-gray-600" 
                            type="datetime-local" 
                            name="date_time" 
                            required />
                        <x-input-error :messages="$errors->get('date_time')" class="mt-2" />
                    </div>

                    {{-- Lokasi (Full Width) --}}
                    <div class="md:col-span-2">
                        <x-input-label for="location" :value="__('Lokasi')" class="text-gray-700 font-semibold" />
                        <p class="text-gray-700 text-sm font-md"><span class="text-red-500 font-bold">* </span>Penulisan lokasi harus diakhiri dengan nama kota</p>
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <x-text-input wire:model="location" id="location" 
                                class="block w-full pl-10 rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] shadow-sm placeholder:text-gray-400" 
                                type="text" 
                                name="location" 
                                placeholder="Nama Lokasi atau Alamat Lengkap, Kota"
                                required />
                        </div>
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    {{-- Deskripsi (Full Width) --}}
                    <div class="md:col-span-2">
                        <x-input-label for="description" :value="__('Deskripsi Event')" class="text-gray-700 font-semibold" />
                        <textarea wire:model="description" id="description" name="description"
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] shadow-sm placeholder:text-gray-400 transition-shadow"
                            rows="6"
                            placeholder="Deskripsikan eventmu semenarik mungkin..."></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="md:col-span-2">
                        <x-input-label for="new_image" :value="__('Gambar Cover Event')" class="text-gray-700 font-semibold mb-2" />

                        {{-- Wrapper Lebar 1/2 di Desktop --}}
                        <div class="w-full md:w-1/2">
                            <div class="relative group">
                                
                                <input wire:model="new_image" id="new_image" name="new_image" type="file" accept="image/*" class="sr-only">

                                {{-- Container --}}
                                <label for="new_image" 
                                    class="flex flex-col items-center justify-center w-full min-h-[200px] border-2 border-dashed rounded-xl cursor-pointer transition-all duration-300 overflow-hidden relative bg-white
                                    {{ $errors->has('new_image') ? 'border-red-300 bg-red-50' : 'border-gray-300 hover:bg-gray-50 hover:border-[#fc563c]/50' }}">
                                    
                                    {{-- KONDISI 1: Preview Gambar --}}
                                    @if ($new_image && !$errors->has('new_image'))
                                        
                                        <img src="{{ $new_image->temporaryUrl() }}" class="w-full h-auto object-contain">
                                        
                                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity h-full w-full">
                                            <span class="bg-white/90 backdrop-blur px-4 py-2 rounded-full text-sm font-bold text-gray-800 shadow-lg">
                                                Ganti Gambar
                                            </span>
                                        </div>
                                    {{-- KONDISI 3: Default (Upload Awal atau Jika Error) --}}
                                    @else
                                        <div class="flex flex-col items-center justify-center py-10">
                                            <div class="mb-3 p-3 rounded-full bg-gray-100 text-gray-400 group-hover:text-[#fc563c] group-hover:bg-orange-50 transition-colors">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                </svg>
                                            </div>
                                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold text-[#fc563c]">Klik upload</span> atau drag & drop</p>
                                            <p class="text-xs text-gray-400">PNG, JPG, GIF (Maks. 2MB)</p>
                                        </div>
                                    @endif

                                    {{-- Loading Overlay --}}
                                    <div wire:loading wire:target="new_image" class="absolute inset-0 bg-white/80 backdrop-blur-sm flex flex-col items-center justify-center z-20 h-full w-full">
                                        <svg class="animate-spin h-8 w-8 text-[#fc563c] mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        <span class="text-sm font-bold text-[#fc563c] animate-pulse">Mengupload...</span>
                                    </div>
                                </label>
                            </div>
                            {{-- Pesan eror --}}
                            <x-input-error :messages="$errors->get('new_image')" class="mt-2" />
                        </div>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('organizer.dashboard') }}" class="text-sm font-medium px-6 py-3 rounded-xl text-gray-700 border hover:border-[#fc563c] hover:text-gray-900 transition-colors">
                        Batal
                    </a>
                    
                    <x-primary-button class="bg-[#fc563c] hover:bg-[#e4482e] focus:ring-[#fc563c] px-6 py-3 rounded-xl shadow-lg shadow-orange-100">
                        {{ $event ? 'Simpan Perubahan' : 'Buat Event Sekarang' }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>