<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }
}; ?>

<div class="min-h-screen flex flex-col justify-center items-center bg-beige sm:pt-0">
    
    {{-- Card Container --}}
    <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-none sm:shadow-xl overflow-hidden sm:rounded-3xl border-0 sm:border border-gray-100">
        <a href="/" class="text-center mb-4">
            <x-application-logo class="w-26 h-26 fill-current" />
        </a>
        {{-- Header --}}
        <div class="mb-8 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                Selamat Datang
            </h2>
            <p class="mt-2 text-sm text-gray-500">
                Masuk ke akun Olinevent Anda
            </p>
        </div>

        <x-auth-session-status class="mb-6" :status="session('status')" />

        <form wire:submit="login">
            <div class="mb-5">
                <x-input-label for="email" :value="__('Alamat Email')" class="text-gray-700 font-bold text-xs uppercase tracking-wider" />
                <x-text-input wire:model="form.email" id="email" 
                    class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 transition-shadow shadow-sm placeholder:text-gray-300" 
                    type="email" 
                    name="email" 
                    required autofocus autocomplete="username" 
                    placeholder="nama@email.com" />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <div class="mb-6">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-bold text-xs uppercase tracking-wider" />
                
                <x-text-input wire:model="form.password" id="password" 
                    class="block mt-2 w-full rounded-xl border-gray-300 focus:border-[#fc563c] focus:ring-[#fc563c] py-3 transition-shadow shadow-sm placeholder:text-gray-300"
                    type="password" 
                    name="password" 
                    required autocomplete="current-password" 
                    placeholder="••••••••" />

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mb-8">
                <label for="remember" class="inline-flex items-center cursor-pointer">
                    <input wire:model="form.remember" id="remember" type="checkbox" 
                        class="rounded border-gray-300 text-[#fc563c] shadow-sm focus:ring-[#fc563c]/50 cursor-pointer" 
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-[#fc563c] hover:text-[#e4482e] hover:underline transition-colors" 
                       href="{{ route('password.request') }}">
                        {{ __('Lupa password?') }}
                    </a>
                @endif
            </div>

            <div class="flex flex-col gap-4">
                <x-primary-button class="w-full justify-center py-3.5 text-base font-bold !bg-[#fc563c] hover:bg-[#e4482e] active:bg-[#d63f25] focus:ring-[#fc563c] rounded-xl shadow-lg shadow-orange-200 transition-all duration-200 transform hover:-translate-y-0.5">
                    {{ __('Masuk Sekarang') }}
                </x-primary-button>
                
                {{-- Opsi Daftar --}}
                <div class="text-center mt-2">
                    <p class="text-sm text-gray-500">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-bold text-[#fc563c] hover:text-[#e4482e] hover:underline">
                            Daftar disini
                        </a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>