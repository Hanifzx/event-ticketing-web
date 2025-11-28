@props([
    'action', 
    'title' => 'Konfirmasi Tindakan', 
    'message' => 'Apakah Anda yakin ingin melanjutkan proses ini?',
    'confirmText' => 'Ya, Lanjutkan',
    'cancelText' => 'Batal'
])

<div x-data="{ open: false }" class="w-full">
    
    {{-- 1. TRIGGER BUTTON --}}
    <x-primary-button type="button"
                      @click="open = true" 
                      {{ $attributes->merge(['class' => 'hover:bg-[#e4482e] focus:bg-[#e4482e] active:bg-[#e4482e] focus:ring-[#e4482e] w-full justify-center']) }}>
        {{ $slot }}
    </x-primary-button> 

    {{-- 2. MODAL OVERLAY --}}
    <div x-show="open" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[999] overflow-y-auto" 
         aria-labelledby="modal-title" 
         role="dialog" 
         aria-modal="true">
        
        {{-- Backdrop Blur --}}
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity" 
                 @click="open = false" 
                 aria-hidden="true">
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            {{-- Modal Panel --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-sm w-full border border-gray-100">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        {{-- Icon Warning --}}
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-[#fc563c]/10 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-[#fc563c]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                        </div>
                        
                        {{-- Konten Teks --}}
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                {{ $title }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 whitespace-normal break-words">
                                    {{ $message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer Buttons --}}
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                    {{-- Tombol Konfirmasi --}}
                    <button type="button" 
                            @click="open = false; $wire.{{ $action }}"
                            class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-[#fc563c] text-base font-medium text-white hover:bg-[#e4482e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fc563c] sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        {{ $confirmText }}
                    </button>
                    
                    {{-- Tombol Batal --}}
                    <button type="button" 
                            @click="open = false"
                            class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fc563c] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                        {{ $cancelText }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>