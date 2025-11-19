<x-guest-layout>
    <div class="text-center">
        <svg class="mx-auto h-12 w-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>

        <h2 class="mt-4 text-xl font-bold text-red-600">Pendaftaran Ditolak</h2>
        
        <p class="mt-2 text-sm text-gray-600">
            Mohon maaf, pendaftaran Event Organizer Anda tidak dapat kami setujui saat ini.
            Silakan hubungi admin untuk info lebih lanjut atau hapus akun untuk mendaftar ulang.
        </p>

        <div class="mt-8 space-y-4">
            <div class="p-4 bg-red-50 border border-red-100 rounded-lg">
                <h3 class="text-sm font-medium text-red-800">Hapus Akun Saya</h3>
                <div class="mt-2">
                    <livewire:profile.delete-user-form />
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-gray-900 underline">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>