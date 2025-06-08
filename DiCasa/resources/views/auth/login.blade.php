<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Usuário')" class="text-black"/>
            <x-text-input id="email" class="block mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                style="background-color: #d9d9d9; border-color: #d1d5db; width: 120%;" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" class="text-black" />
            <x-text-input id="password" class="block mt-1" type="password" name="password" required autocomplete="current-password"
                style="background-color: #d9d9d9; border-color: #d1d5db; width: 120%;" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    style="background-color:rgb(128, 128, 128);"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
            </label>
        </div>

        <div class="mt-4" style="width: 120%; margin: 0 auto;">
            @if (Route::has('password.request'))
                <div class="text-center mb-5">
                    <a class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Esqueci minha senha') }}
                    </a>
                </div>
            @endif

            <div class="text-center">
                <x-primary-button class="px-8">
                    {{ __('Entrar') }}
                </x-primary-button>
            </div>
        </div>

    </form>
</x-guest-layout>

