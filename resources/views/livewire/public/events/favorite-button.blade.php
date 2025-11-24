<button 
    wire:click.prevent="toggle" 
    class="w-full flex items-center justify-center px-4 py-2 border rounded-md text-sm font-medium transition-colors duration-150 
           {{ $isFavorite 
               ? 'bg-red-50 border-red-200 text-red-600 hover:bg-red-100' 
               : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50' }}"
>
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="w-5 h-5 mr-2 {{ $isFavorite ? 'fill-current' : 'fill-none stroke-current' }}" 
         viewBox="0 0 24 24" 
         stroke="currentColor" 
         stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" 
              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
    </svg>

    <span>
        {{ $isFavorite ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
    </span>
</button>