<div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-900">{{ $ticket->event->name ?? 'Event Name' }}</h1>
        <p class="text-gray-600 mt-1">Tiket: <span class="font-semibold">{{ $ticket->name }}</span></p>
    </div>

    <div class="flex justify-between items-center mb-6 bg-gray-50 p-4 rounded">
        <div>
            <p class="text-sm text-gray-500">Harga Satuan</p>
            <p class="text-lg font-bold text-indigo-600">Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Sisa Kuota</p>
            <p class="font-medium {{ $ticket->quota > 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ $ticket->quota }} Tiket
            </p>
        </div>
    </div>

    @if($ticket->quota > 0)
        <form wire:submit="book">
            <!-- Input Quantity -->
            <div class="mb-6">
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                    Mau beli berapa tiket?
                </label>
                <div class="flex items-center">
                    <input 
                        wire:model.live="quantity" 
                        type="number" 
                        id="quantity"
                        min="1" 
                        max="{{ $ticket->quota }}"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5"
                    >
                </div>
                @error('quantity') 
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                @enderror
            </div>

            <!-- Total Summary -->
            <div class="flex justify-between items-center border-t pt-4 mb-6">
                <span class="text-lg font-semibold text-gray-800">Total Pembayaran:</span>
                <span class="text-2xl font-bold text-indigo-700">
                    Rp {{ number_format($totalPrice, 0, ',', '.') }}
                </span>
            </div>

            <x-primary-button class="w-full justify-center py-3 text-base" wire:loading.attr="disabled">
                <span wire:loading.remove>Konfirmasi Pemesanan</span>
                <span wire:loading>Memproses Transaksi...</span>
            </x-primary-button>
        </form>
    @else
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
            <strong class="font-bold">Mohon Maaf!</strong>
            <span class="block sm:inline">Tiket ini sudah habis terjual.</span>
        </div>
    @endif
</div>