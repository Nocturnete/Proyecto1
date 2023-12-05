<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-black text-5xl md:text-4xl lg:text-4xl lg:mt-3 dark:text-white">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="w-full mx-auto h-full">
            <!-- IDIOMA -->
            <div class=" mt-6 mb-7 bg-gray-200 shadow sm:rounded-lg sm:pt-8 sm:pb-2 sm:pl-8 lg:ml-16 lg:mr-16 dark:bg-gray-800">
                <p class="text-xl mb-5 dark:text-white">{{ __('Idioma') }}</p>
                <x-language-switcher/>
            </div>
            <!-- INFORMACION -->
            <div class="mt-6 mb-7 bg-gray-200 shadow sm:rounded-lg sm:p-8 lg:ml-16 lg:mr-16 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- ACTUALIZAR -->
            <div class="mt-6 mb-7 bg-gray-200 shadow-md
            sm:p-8 lg:ml-16 lg:mr-16 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <!-- BORRAR -->
            <div class="mt-6 mb-7 bg-gray-200 shadow sm:rounded-lg sm:p-8 lg:ml-16 lg:mr-16 dark:bg-gray-800">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            <!-- CERRAR SESION -->
            <div class="p-4 mt-6 mb-7 sm:p-8 lg:ml-16 lg:mr-16 ">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center p-3  mb-8 space-x-2 rounded-lg px-3 py-2 text-white bg-red-600 cursor-pointer hover:bg-red-500 shadow" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fi-sr-exit mt-1"></i>
                        <span class="font-bold">{{__('Logout')}}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>