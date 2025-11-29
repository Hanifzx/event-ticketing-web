    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 w-full h-full max-w-sm max-h-md">
        {{-- Header info --}}
        <div class="flex-1 flex-col justify-start mb-6 border-b pb-3">
            <h1 class="text-2xl font-semibold text-gray-900">
                Tiket: <span class="font-bold">{{ $ticket->name }}</span>
            </h1>
            @if($ticket->description)
                <p class="min-h-[2.5rem] text-xs text-gray-600 mt-2 bg-gray-50 rounded-lg border border-gray-100 leading-relaxed">
                    {{ $ticket->description }}
                </p>
            @else
                <p class="min-h-[2.5rem] text-xs text-gray-600 mt-2 italic">Tidak ada deskripsi untuk tiket ini.</p>
            @endif
        </div>

        {{-- WRAPPER ALPINE JS --}}
        <div x-data="{ 
            qty: @entangle('quantity'), 
            price: {{ $ticket->price }},
            max: {{ $maxLimit }} 
        }">

            <div class="flex justify-between items-center mb-6 bg-gray-50 p-4 rounded">
                <div>
                    <p class="text-sm text-gray-500">Harga Satuan</p>
                    <p class="text-lg font-bold text-black">
                        Rp {{ number_format($ticket->price, 0, ',', '.') }}
                    </p>
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
                    <div class="mb-6">
                        <div class="flex justify-between">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah Tiket
                            </label>
                            @if($ticket->max_purchase_per_user > 0)
                                <span class="text-xs text-orange-600 font-semibold">
                                    (Maks. {{ $ticket->max_purchase_per_user }} tiket per transaksi)
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center">
                            <input 
                                x-model="qty"
                                x-on:input="if(qty > max) qty = max; if(qty < 1) qty = 1;"
                                type="number"
                                id="quantity"
                                min="1"
                                max="{{ $maxLimit }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#fc563c] focus:ring-[#fc563c] sm:text-sm p-2.5"
                            >
                        </div>
                        
                        <p class="mt-1 text-xs text-gray-500">
                            Anda dapat membeli maksimal {{ $maxLimit }} tiket saat ini.
                        </p>

                        @error('quantity') 
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div class="flex justify-between items-center border-t pt-4 mb-6">
                        <span class="text-lg font-semibold text-gray-800">Total Pembayaran:</span>
                        <span class="text-2xl font-bold text-black">
                            Rp <span x-text="(qty * price).toLocaleString('id-ID')"></span>
                        </span>
                    </div>

                    <x-confirm-button 
                        action="book()" 
                        class="w-full justify-center py-3 text-base !bg-[#fc563c] hover:bg-[#e4482e] transition-all duration-200 transform hover:-translate-y-0.5"
                        title="Konfirmasi Pemesanan"
                        message="Pastikan jumlah dan jenis tiket sudah benar. Lanjutkan pembayaran?">
                        <span>Konfirmasi Pemesanan</span>
                    </x-confirm-button>
                </form>
            @else
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center" role="alert">
                    <strong class="font-bold">Mohon Maaf!</strong>
                    <span class="block sm:inline">Tiket ini sudah habis terjual.</span>
                </div>
            @endif

        </div> 
    </div>