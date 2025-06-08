<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <!-- Container principal com margens reduzidas -->
        <div class="mx-[20%] space-y-6">
            <!-- Quadros brancos com largura máxima aumentada -->
            <div class="flex justify-center">
                <div class="w-full max-w-2xl p-4 sm:p-8 bg-gray-100 dark:bg-gray-100 shadow sm:rounded-lg">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="flex justify-center">
                <div class="w-full max-w-2xl p-4 sm:p-8 bg-gray-100 dark:bg-gray-100 shadow sm:rounded-lg">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="flex justify-center">
                <div class="w-full max-w-2xl p-4 sm:p-8 bg-gray-100 dark:bg-gray-100 shadow sm:rounded-lg">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>