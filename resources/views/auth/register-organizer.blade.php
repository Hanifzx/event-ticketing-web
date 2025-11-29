<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: false);
    }
}; ?>

<x-base-layout title="Daftar OEM - Olinevent">
    <div class="min-h-screen flex items-center justify-center bg-beige py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="max-w-5xl w-full bg-white rounded-3xl overflow-hidden flex flex-col lg:flex-row border border-gray-100">
            
            {{-- KOLOM KIRI --}}
            <div class="hidden lg:block lg:w-1/2 bg-cover bg-center relative" 
                 style="background-image: url('https://images.unsplash.com/photo-1522158637959-30385a09e0da?q=80&w=1170&auto=format&fit=crop');">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 p-10 w-full text-white">
                    <div class="mb-3 inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 text-[10px] font-bold uppercase tracking-wider">
                        <svg class="w-3.5 h-3.5 text-[#fc563c]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99z"/></svg>
                        Official Partner
                    </div>
                    <h3 class="text-3xl font-extrabold mb-2 leading-tight">
                        Partner Olinevent
                    </h3>
                    <p class="text-base text-gray-200 font-light leading-relaxed">
                        Bergabunglah sebagai <span class="font-semibold text-[#fc563c]">Olinevent Event Manager (OEM)</span>.
                    </p>
                </div>
            </div>

            {{-- KOLOM KANAN --}}
            <div class="w-full lg:w-1/2 p-6 sm:p-10 lg:p-12 flex flex-col justify-center">
                
                {{-- Logo Mobile --}}
                <div class="lg:hidden mb-6 text-center">
                    <x-application-logo class="text-3xl fill-current" />
                </div>

                <div class="text-center lg:text-left mb-8">
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                        Registrasi Akun OEM
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Daftarkan organisasi Anda untuk mulai membuat event.
                    </p>
                </div>

                <form wire:submit="register" method="POST" action="{{ route('organizer.register') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nama Organizer / Perusahaan')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="name" id="name" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 shadow-sm placeholder:text-gray-400" 
                            type="text" name="name" required autofocus autocomplete="name" placeholder="Nama OEM/Organizer/PT" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Alamat Email Bisnis')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="email" id="email" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 shadow-sm placeholder:text-gray-400" 
                            type="email" name="email" required autocomplete="username" placeholder="contact@gmail.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="password" id="password" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 shadow-sm placeholder:text-gray-400"
                            type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-semibold" />
                        <x-text-input wire:model="password_confirmation" id="password_confirmation" 
                            class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 shadow-sm placeholder:text-gray-400"
                            type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <div class="flex flex-col gap-4">
                        <x-primary-button class="w-full justify-center py-3.5 text-base font-bold !bg-[#fc563c] hover:bg-[#e4482e] active:bg-[#d63f25] focus:ring-[#fc563c] rounded-xl shadow-md shadow-orange-200 transition-all duration-200 transform hover:-translate-y-0.5">
                            {{ __('Daftar sebagai OEM') }}
                        </x-primary-button>

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Sudah punya akun OEM?</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <a class="text-md font-bold text-[#fc563c] hover:text-[#e4482e] underline transition-colors" href="{{ route('login') }}" wire:navigate>
                                {{ __('Login') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-base-layout>

