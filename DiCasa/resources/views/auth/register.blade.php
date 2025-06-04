<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        @if(session('success'))
        <div x-data="{ show: true }" 
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="background-color: #d9d9d9; border-color: #d1d5db;"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" style="background-color: #d9d9d9; border-color: #d1d5db;"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            style="background-color: #d9d9d9; border-color: #d1d5db;" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            style="background-color: #d9d9d9; border-color: #d1d5db;"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>


            <x-primary-button class="ms-4">
                {{ __('Cadastrar') }}
            </x-primary-button>

        </div>
    </form>
</x-guest-layout>
