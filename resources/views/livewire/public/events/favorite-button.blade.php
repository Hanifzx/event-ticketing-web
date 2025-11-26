<div>
    <button wire:click="toggle" 
            class="group relative flex items-center justify-center w-10 h-10 rounded-full transition-all duration-200 focus:outline-none"
            title="{{ $isFavorite ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}">
        
        <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-8 h-8 transition-colors duration-300 {{ $isFavorite ? 'text-rose-500 fill-rose-500' : 'text-gray-400 fill-none group-hover:text-gray-600' }}" 
             viewBox="0 0 24 24" 
             stroke="currentColor" 
             stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" 
                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>

    </button>
</div>