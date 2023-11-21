<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="h-full w-full p-8 bg-blue-300 rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-40 border border-gray-100">
        <div class="
                pt-5 pb-5
                sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Iniciar sesión</h2>
        </div>

        <div class="z-10 mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Correo electronico -->
                <div class="rounded-lg">
                    <div class="relative bg-inherit">
                        <input type="email" id="email" name="email" autocomplete="email" placeholder="Correo electrónico" class="peer w-full h-10 rounded-lg placeholder-transparent text-black ring-1 focus:outline-none @error('password') ring-red-500 @enderror"/>
                        <label for="email" class="absolute cursor-text left-0 -top-3 mx-2 px-1 text-sm pointer-events-none peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sm transition-all peer-focus:bg-customblue peer-focus:text-white peer-focus:rounded-lg">Correo electrónico</label>
                    </div>
                    @error('email')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="rounded-lg">
                    <div class="relative bg-inherit">
                        <input type="password" id="password" name="password" placeholder="Contraseña" class="peer w-full h-10 rounded-lg placeholder-transparent text-black ring-1 focus:outline-none @error('password') ring-red-500 @enderror"/>
                        <label for="password" class="absolute cursor-text left-0 -top-3 mx-2 px-1 text-sm pointer-events-none peer-placeholder-shown:text-base peer-placeholder-shown:top-2 peer-focus:-top-3 peer-focus:text-sm transition-all peer-focus:bg-customblue peer-focus:text-white peer-focus:rounded-lg">Contraseña</label>
                    </div>
                    @error('password')
                        <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <!-- Recuérdame -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recuérdame') }}</span>
                        </label>
                    </div>

                    <!-- Restablecer la contraseña -->
                    <div class="flex items-center mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('¿Has olvidado la contraseña?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Iniciar sesión -->
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                </div>

            </form>
            
            <!-- Registrar-se -->
            <div>
                <a href="{{ route('register') }}" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registrar-se</a>
            </div>

        </div>
    </div>
</x-guest-layout>
