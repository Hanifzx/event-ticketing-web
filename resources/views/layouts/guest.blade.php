<x-base-layout title="Olinevent | Beli Tiket Event Online Mudah & Cepat">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-beige">
        {{-- <div clas="bg-beige">
            <a href="/" class="mt-4">
                <x-application-logo class="w-26 h-26 fill-current" />
            </a>
        </div> --}}

        <div class="w-full sm:max-w-md px-6 overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</x-base-layout>