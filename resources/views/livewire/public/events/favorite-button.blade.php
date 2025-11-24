<button 
    wire:click.prevent="toggle" 
    class="p-2 rounded-full bg-white/80 backdrop-blur-sm hover:bg-white shadow-sm transition-all duration-200 focus:outline-none group"
    title="{{ $isFavorite ? 'Hapus dari Favorit' : 'Simpan ke Favorit' }}"
>
    {{-- Bintang --}}
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5 transition-colors duration-200 {{ $isFavorite ? 'text-yellow-400 fill-yellow-400' : 'text-gray-400 group-hover:text-gray-600' }}" 
         viewBox="0 0 24 24" 
         stroke="currentColor" 
         stroke-width="{{ $isFavorite ? '0' : '2' }}">
        <path stroke-linecap="round" stroke-linejoin="round" 
              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
    </svg>
</button>