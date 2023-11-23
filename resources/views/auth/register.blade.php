<x-guest-layout>
    <div class="h-full w-full p-4 lg:bg-white lg:rounded-lg lg:bg-clip-padding lg:backdrop-filter lg:backdrop-blur-md lg:border lg:shadow-lg lg:border-white lg:bg-opacity-70 dark:border-black dark:bg-opacity-50 md:bg-white md:rounded-lg md:bg-clip-padding md:backdrop-filter md:backdrop-blur-md md:border md:shadow-lg md:border-white md:bg-opacity-70 dark:lg:bg-black dark:lg:border-black dark:lg:bg-opacity-50 dark:md:bg-black dark:md:border-black dark:md:bg-opacity-50">    
        <div class="pt-5 pb-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <i class="fi-sr-user-add text-8xl flex w-full justify-center text-customblue"></i>
        </div>

        <div class="z-10 mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Nombre -->
                <div class="rounded-lg">
                    <div class="relative bg-inherit">
                        <input type="text" id="name" name="name" placeholder="Nombre" class="peer w-full h-10 rounded-lg placeholder-transparent text-black ring-1 focus:outline-none dark:bg-gray-800 dark:text-white @error('name') ring-red-500 @enderror" />
                        <label for="name" class="absolute cursor-text left-0 bg-white rounded-lg -top-3 mx-2 px-1 text-sm pointer-events-none peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sm transition-all peer-focus:bg-customblue peer-focus:text-white peer-focus:rounded-lg dark:bg-gray-800 dark:text-white">{{ __('Nombre') }}</label>
                    </div>
                    @error('name')
                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Correo electronico -->
                <div class="rounded-lg">
                    <div class="relative bg-inherit">
                        <input type="email" id="email" name="email" autocomplete="email" placeholder="Correo electrónico" class="peer w-full h-10 rounded-lg placeholder-transparent text-black ring-1 focus:outline-none dark:bg-gray-800 dark:text-white @error('email') ring-red-500 @enderror" />
                        <label for="email" class="absolute cursor-text left-0 -top-3 bg-white rounded-lg mx-2 px-1 text-sm pointer-events-none peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sm transition-all peer-focus:bg-customblue peer-focus:text-white peer-focus:rounded-lg dark:bg-gray-800 dark:text-white">{{ __('Correo electrónico') }}</label>
                    </div>
                    @error('email')
                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="rounded-lg">
                    <div class="relative bg-inherit">
                        <input type="password" id="password" name="password" placeholder="Contraseña" class="peer w-full h-10 rounded-lg placeholder-transparent text-black ring-1 focus:outline-none dark:bg-gray-800 dark:text-white @error('password') ring-red-500 @enderror" />
                        <label for="password" class="absolute cursor-text left-0 -top-3 mx-2 px-1 transition-all text-sm pointer-events-none bg-white rounded-lg peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sm peer-focus:bg-customblue peer-focus:text-white peer-focus:rounded-lg dark:bg-gray-800 dark:text-white">{{ __('Contraseña') }}</label>
                    </div>
                    @error('password')
                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="rounded-lg">
                    <div class="relative bg-inherit">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirma contraseña" class="peer w-full h-10 rounded-lg placeholder-transparent text-black ring-1 focus:outline-none dark:bg-gray-800 dark:text-white @error('password_confirmation') ring-red-500 @enderror" />
                        <label for="password_confirmation" class="absolute cursor-text left-0 -top-3 mx-2 px-1 transition-all text-sm pointer-events-none bg-white rounded-lg peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sm peer-focus:bg-customblue peer-focus:text-white peer-focus:rounded-lg dark:bg-gray-800 dark:text-white">{{ __('Confirma contraseña') }}</label>
                    </div>
                    @error('password_confirmation')
                    <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Registrar-se -->
                <div>
                    <button type="submit" class="flex w-full mb-5 mx-auto justify-center rounded-md bg-customblue px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm lg:w-40 hover:bg-blue-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Register') }}</button>
                </div>
            </form>

            <!-- Iniciar sesión -->
            <div>
                <a href="{{ route('login') }}" class="flex w-full justify-center text-sm font-bold leading-6 text-customblue hover:text-blue-800 dark:text-white">{{ __('Already registered?') }}</a>
            </div>
        </div>
    </div>
</x-guest-layout>