<div class="px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        {{-- Filter Kategori --}}
        <div x-data="{ open:false }" class="relative">
            {{-- Button --}}
            <button 
                @click="open = !open"
                class="w-full flex justify-between items-center 
                       border border-[#172a39] px-4 py-2 rounded-full shadow-sm text-left leading-none">
                <span class="text-sm md:text-md">
                    {{ $category ?: 'Semua Kategori' }}
                </span>
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            {{-- Dropdown --}}
            <div 
                x-show="open"
                @click.outside="open = false"
                class="absolute z-20 mt-2 w-full bg-beige border rounded-xl shadow-md max-h-60 overflow-auto"
            >
                {{-- Default option --}}
                <div 
                    class="px-4 py-2 hover:text-oranye cursor-pointer text-sm md:text-md"
                    @click="$wire.set('category', ''); open=false"
                >
                    Semua Kategori
                </div>

                {{-- Loop kategori --}}
                @foreach($categories as $cat)
                <div 
                    class="px-4 py-2 hover:text-oranye cursor-pointer text-sm md:text-md"
                    @click="$wire.set('category', '{{ $cat }}'); open=false"
                >
                    {{ $cat }}
                </div>
                @endforeach
            </div>
        </div>

        {{-- Filter Lokasi --}}
        <div x-data="{ open:false }" class="relative">
            <button 
                @click="open = !open"
                class="w-full flex justify-between items-center 
                       border border-[#172a39] px-4 py-2 rounded-full shadow-sm text-left leading-none">
                <span class="text-sm md:text-md">
                    {{ $location ?: 'Semua Lokasi' }}
                </span>
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div 
                x-show="open"
                @click.outside="open = false"
                class="absolute z-20 mt-2 w-full bg-beige border rounded-xl shadow-md max-h-60 overflow-auto"
            >
                <div 
                    class="px-4 py-2 hover:text-oranye cursor-pointer text-sm md:text-md"
                    @click="$wire.set('location', ''); open=false"
                >
                    Semua Lokasi
                </div>

                @foreach($locations as $loc)
                <div 
                    class="px-4 py-2 hover:text-oranye cursor-pointer text-sm md:text-md"
                    @click="$wire.set('location', '{{ $loc }}'); open=false"
                >
                    {{ $loc }}
                </div>
                @endforeach
            </div>
        </div>

        {{-- Filter Waktu (Bulan) --}}
        <div x-data="{ open:false }" class="relative">
            <button 
                @click="open = !open"
                class="w-full flex justify-between items-center bg-beige 
                       border border-[#172a39] px-4 py-2 rounded-full shadow-sm text-left text-sm md:text-md leading-none">
                <span>
                    {{ $month ? $months[$month] : 'Semua Bulan' }}
                </span>
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div 
                x-show="open"
                @click.outside="open = false"
                class="text-sm md:text-md absolute z-20 mt-2 w-full bg-beige border rounded-xl shadow-md max-h-60 overflow-auto"
            >
                {{-- default --}}
                <div 
                    class="px-4 py-2 hover:text-oranye cursor-pointer"
                    @click="$wire.set('month', ''); open=false"
                >
                    Semua Bulan
                </div>

                {{-- loop bulan --}}
                @foreach($months as $key => $name)
                <div 
                    class="px-4 py-2 hover:text-oranye cursor-pointer"
                    @click="$wire.set('month', '{{ $key }}'); open=false"
                >
                    {{ $name }}
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
