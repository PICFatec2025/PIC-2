<x-app-layout>
    <style>
        .navigation-top { 
            position: fixed; 
            top: 0; 
            left: 0; 
            right: 0; 
            z-index: 50; 
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 4rem; /* Espaço para a navegação fixa */
        }
        .input-group {
            width: 100%;
            max-width: 600px; /* Largura máxima aumentada */
            margin-bottom: 1.5rem;
        }
    </style>

    <div class="navigation-top">
        @include('layouts.navigation')
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('register') }}" class="w-full max-w-2xl">
            @csrf

            @if(session('success'))
            <div x-data="{ show: true }" 
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 3000)"
                class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded input-group">
                {{ session('success') }}
            </div>
            @endif

            <!-- Name -->
            <div class="input-group">
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="background-color: #d9d9d9; border-color: #d1d5db;"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="input-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" style="background-color: #d9d9d9; border-color: #d1d5db;"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="input-group">
                <x-input-label for="password" :value="__('Senha')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password"
                                style="background-color: #d9d9d9; border-color: #d1d5db;" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="input-group">
                <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" 
                                style="background-color: #d9d9d9; border-color: #d1d5db;"/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Botão Cadastrar -->
            <div class="input-group mt-6 flex justify-center">
                <x-primary-button class="px-8 py-3 text-lg">
                    {{ __('Cadastrar') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>