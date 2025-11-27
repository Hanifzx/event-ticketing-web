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

<div class="min-h-screen flex flex-col justify-center items-center bg-beige my-10 sm:pt-0">
    {{-- Card Container --}}
    <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-none sm:shadow-xl overflow-hidden sm:rounded-3xl border-0 sm:border border-gray-100">
        <a href="/" class="text-center mb-4">
            <x-application-logo class="w-26 h-26 fill-current" />
        </a>
        
        {{-- Header --}}
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Buat Akun Baru
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Daftar untuk mulai memesan tiket event
            </p>
        </div>

        <form wire:submit="register">
            <div class="mb-5">
                <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700 font-bold text-xs uppercase tracking-wider" />
                <x-text-input wire:model="name" id="name" 
                    class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 transition-shadow shadow-sm placeholder:text-gray-300" 
                    type="text" 
                    name="name" 
                    required autofocus autocomplete="name" 
                    placeholder="Nama Anda" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-5">
                <x-input-label for="email" :value="__('Alamat Email')" class="text-gray-700 font-bold text-xs uppercase tracking-wider" />
                <x-text-input wire:model="email" id="email" 
                    class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 transition-shadow shadow-sm placeholder:text-gray-300" 
                    type="email" 
                    name="email" 
                    required autocomplete="username" 
                    placeholder="nama@email.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-5">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-bold text-xs uppercase tracking-wider" />
                <x-text-input wire:model="password" id="password" 
                    class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 transition-shadow shadow-sm placeholder:text-gray-300"
                    type="password" 
                    name="password" 
                    required autocomplete="new-password" 
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-8">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-bold text-xs uppercase tracking-wider" />
                <x-text-input wire:model="password_confirmation" id="password_confirmation" 
                    class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 transition-shadow shadow-sm placeholder:text-gray-300"
                    type="password" 
                    name="password_confirmation" 
                    required autocomplete="new-password" 
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-4">
                <x-primary-button class="w-full justify-center py-3.5 text-base font-bold !bg-[#fc563c] hover:bg-[#e4482e] active:bg-[#d63f25] focus:ring-[#fc563c] rounded-xl shadow-lg shadow-orange-200 transition-all duration-200 transform hover:-translate-y-0.5">
                    {{ __('Daftar Sekarang') }}
                </x-primary-button>

                <div class="text-center mt-2">
                    <p class="text-sm text-gray-500">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-bold text-[#fc563c] hover:text-[#e4482e] hover:underline">
                            Masuk disini
                        </a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>