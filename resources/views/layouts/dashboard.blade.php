<x-base-layout :title="$title ?? 'OEM | Olinevent'">
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-beige z-40 md:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-beige transition-transform duration-300 md:relative md:translate-x-0">
            <livewire:partials.sidebar />
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-beige md:hidden h-16 flex items-center px-4 justify-between z-30">
                <span class="font-bold text-lg text-gray-800">{{ $title ?? 'Dashboard' }}</span>
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </header>

            <main class="bg-beige flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</x-base-layout>