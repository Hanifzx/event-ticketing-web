<x-guest-layout title="Pendaftaran Ditolak | Olinevent">
    <div class="mb-4 text-sm text-gray-600">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-bold text-lg">Permohonan Ditolak</p>
            <p class="mt-2">
                Mohon maaf, pengajuan Anda untuk menjadi <strong>Event Organizer</strong> telah kami tinjau dan 
                <span class="font-bold underline">DITOLAK</span> oleh Admin.
            </p>
        </div>

        <p class="mb-4">
            Karena status akun Anda ditolak, Anda tidak dapat mengakses fitur Organizer Dashboard. 
            Anda memiliki opsi untuk menghapus akun ini dan mendaftar ulang dengan data yang berbeda jika diinginkan.
        </p>

        <div class="flex items-center justify-between mt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log Out') }}
                </button>
            </form>

            <livewire:organizer.delete-rejected-account />
        </div>
    </div>
</x-guest-layout>