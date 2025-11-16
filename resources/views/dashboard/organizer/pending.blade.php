<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menunggu Persetujuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Akun Anda sedang Ditinjau</h3>
                    <p class="mt-2">
                        Terima kasih telah mendaftar sebagai Event Organizer. Akun Anda saat ini sedang kami tinjau.
                        <br>
                        Kami akan memberi tahu Anda setelah akun Anda disetujui oleh Admin.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>