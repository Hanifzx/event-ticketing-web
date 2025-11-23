<div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        
        <select wire:model.live="category" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
        </select>

        <select wire:model.live="location" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
            <option value="">Semua Lokasi</option>
            @foreach($locations as $loc)
                <option value="{{ $loc }}">{{ $loc }}</option>
            @endforeach
        </select>

        <select wire:model.live="month" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
            <option value="">Semua Bulan</option>
            @foreach($months as $key => $name)
                <option value="{{ $key }}">{{ $name }}</option>
            @endforeach
        </select>

    </div>
</div>