<div class="bg-white p-4 rounded-lg shadow-md border border-gray-200 w-full max-w-xs min-h-[390px]">

    {{-- Header info --}}
    <div class="flex-1 flex-col justify-start mb-4 border-b pb-2">
        <h1 class="text-xl font-semibold text-gray-500">
            Tiket: <span class="font-bold text-oranye">{{ $ticket->name }}</span>
        </h1>

        @if($ticket->description)
            <p class="min-h-[2rem] max-h-[2rem] text-xs text-gray-600 mt-1 leading-relaxed">
                {{ $ticket->description }}
            </p>
        @else
            <p class="min-h-[2rem] max-h-[2rem] text-xs text-gray-600 mt-1 italic">
                Tidak ada deskripsi untuk tiket ini.
            </p>
        @endif
    </div>

    {{-- WRAPPER ALPINE JS --}}
    <div x-data="{ 
        qty: @entangle('quantity'), 
        price: {{ $ticket->price }},
        max: {{ $maxLimit }} 
    }">

        <div class="flex justify-between items-center mb-4 p-3 rounded">
            <div>
                <p class="text-xs text-gray-500">Harga Satuan</p>
                <p class="text-base font-bold text-black">
                    {{ format_rupiah($ticket->price) }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-xs text-gray-500">Sisa Kuota</p>
                <p class="font-medium {{ $ticket->quota > 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $ticket->quota }} Tiket
                </p>
            </div>
        </div>

        @if($ticket->quota > 0)
            @if($maxLimit > 0)
                <form wire:submit="book">
                    <div class="mb-4">
                        <div class="flex justify-between">
                            <label for="quantity" class="block text-xs font-medium text-gray-700 mb-1">
                                Jumlah Tiket
                            </label>

                            @if($ticket->max_purchase_per_user > 0)
                                <span class="text-[10px] text-orange-600 font-semibold">
                                    (Maks {{ $ticket->max_purchase_per_user }} pembelian tiket)
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
                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                       focus:border-[#fc563c] focus:ring-[#fc563c] 
                                       text-sm p-2"
                            >
                        </div>
                        
                        <p class="mt-1 text-[10px] text-gray-500">
                            Anda masih bisa membeli {{ $maxLimit }} tiket
                        </p>

                        @error('quantity') 
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                        @enderror
                    </div>

                    <div class="flex justify-between items-center border-t pt-3 mb-4">
                        <span class="text-sm font-semibold text-gray-800">
                            Total:
                        </span>
                        <span class="text-lg font-bold text-black">
                            Rp <span x-text="(qty * price).toLocaleString('id-ID')"></span>
                        </span>
                    </div>

                    <x-confirm-button 
                        action="book()" 
                        class="w-full justify-center py-2.5 text-sm !bg-[#fc563c] hover:bg-[#e4482e] transition-all duration-200"
                        title="Konfirmasi Pemesanan"
                        message="Pastikan jumlah dan jenis tiket sudah benar. Lanjutkan pembayaran?">
                        <span>Konfirmasi Pemesanan</span>
                    </x-confirm-button>
                </form>
            @else
                {{-- Jika batas pembelian tercapai --}}
                <div class="bg-white border border-gray-300 rounded-xl p-4 text-center mb-3">
                    <h3 class="text-gray-900 font-bold text-xs mb-1">Batas Pembelian Tercapai</h3>
                    <p class="text-[11px] text-gray-600 leading-relaxed">
                        Anda sudah mencapai batas maksimal pembelian tiket ini.
                    </p>
                </div>
            @endif
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-3 rounded text-center">
                <strong class="font-bold text-sm">Mohon Maaf!</strong>
                <p class="text-xs">Tiket ini sudah habis terjual.</p>
            </div>
        @endif

    </div>
</div>
