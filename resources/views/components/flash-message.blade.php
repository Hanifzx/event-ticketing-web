@php
    $message = '';
    $type = '';

    if (session()->has('error')) {
        $message = session('error');
        $type = 'error';
    } elseif (session()->has('success')) { 
        $message = session('success');
        $type = 'success';
    }
@endphp

<div x-data="{ 
        show: false, 
        message: '{{ session('error') ?? session('success') ?? '' }}', 
        type: '{{ session('error') ? 'error' : (session('success') ? 'success' : '') }}',
        init() {
            if (this.message) {
                this.show = true;
                setTimeout(() => this.show = false, 3000);
            }
            window.addEventListener('flash-message', event => {
                this.message = event.detail.message;
                this.type = event.detail.type;
                this.show = true;
                setTimeout(() => this.show = false, 3000);
            });
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-full"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-full"
    
    {{-- [POSISI] --}}
    class="fixed top-16 left-1/2 -translate-x-1/2 z-[9999] flex items-center p-4 rounded-xl shadow-xl bg-white border border-gray-100 min-w-[320px] max-w-md"
    
    style="display: none;">

    {{-- [WARNA & IKON] --}}
    <div class="flex-shrink-0">
        {{-- Kondisi Error --}}
        <template x-if="type === 'error'">
            {{-- Icon Background --}}
            <div class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center text-red-500 border border-red-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
        </template>
        
        {{-- Kondisi Success --}}
        <template x-if="type === 'success'">
            {{-- Icon Background --}}
            <div class="w-10 h-10 bg-[#fc563c]/10 rounded-full flex items-center justify-center text-[#fc563c] border border-[#fc563c]/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
        </template>
    </div>

    {{-- [TEXT CONTENT] --}}
    <div class="ml-3 flex-1">
        <p class="text-sm font-bold text-gray-900" x-text="type === 'error' ? 'Gagal!' : 'Berhasil!'"></p>
        <p class="text-sm font-medium text-gray-500" x-text="message"></p>
    </div>

    {{-- [TOMBOL CLOSE] --}}
    <button @click="show = false" class="ml-4 text-gray-300 hover:text-gray-500 focus:outline-none transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>