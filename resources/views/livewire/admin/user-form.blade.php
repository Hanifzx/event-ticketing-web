<div>
    <form wire:submit="save">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="role" :value="__('Peran (Role)')" />
                <select wire:model="role" id="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    
                    @if(!$user)
                        <option value="admin">Admin</option>
                        <option value="organizer">Event Organizer</option>
                    @else
                        <option value="user">User (Pengguna Biasa)</option>
                        <option value="organizer">Event Organizer</option>
                        <option value="admin">Admin</option>
                    @endif
                    
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            @if($user)
            <div>
                <x-input-label for="status" :value="__('Status')" />
                <select wire:model="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="active">Active (Untuk User/Admin)</option>
                    <option value="approved">Approved (Untuk Organizer)</option>
                    <option value="pending">Pending (Untuk Organizer)</option>
                    <option value="rejected">Rejected (Untuk Organizer)</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>
            @endif

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" />
                @if($user)
                    <small class="text-gray-500">Kosongkan jika tidak ingin mengubah password.</small>
                @else
                    <small class="text-gray-500">Password wajib diisi untuk akun baru.</small>
                @endif
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                Batal
            </a>
            
            <x-primary-button>
                {{ $user ? 'Perbarui Pengguna' : 'Simpan Pengguna' }}
            </x-primary-button>
        </div>
    </form>
</div>
