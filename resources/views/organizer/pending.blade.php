<x-guest-layout>
    <div class="text-center">
        <svg class="mx-auto h-12 w-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>

        <h2 class="mt-4 text-xl font-bold text-gray-900">Pendaftaran Sedang Ditinjau</h2>
        
        <p class="mt-2 text-sm text-gray-600">
            Terima kasih telah mendaftar sebagai Event Organizer. <br>
            Tim Admin kami sedang memverifikasi data Anda. Mohon menunggu persetujuan.
        </p>

        <div class="mt-6 border-t pt-6">
            <p class="text-xs text-gray-500 mb-4">Ingin kembali nanti?</p>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>