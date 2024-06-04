<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="p-2 space-y-4 md:space-y-6 sm:p-4">
        <div id="logo-login">
            <img class="w-20 h-20" src="{{ asset("img/Isotipo-white.png") }}">
        </div>
        <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white">
            Inicia sesión
        </h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" class="block mb-2 text-md font-medium text-gray-900 dark:text-white" :value="__('Correo electrónico')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="name@company.com" autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" class="block mb-2 text-md font-medium text-gray-900 dark:text-white" :value="__('Contraseña')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              placeholder="••••••••"
                              required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>-->

            <!-- Register Link -->
            <p class="text-xs font-light text-gray-500 dark:text-gray-400 mt-4">
                ¿Aún no tienes una cuenta? <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Crea una cuenta</a>
            </p>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3 mt-4 text-white px-auto text-center bg-black hover:bg-purple-500 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm dark:bg-purple-300 dark:hover:bg-purple-900 dark:hover:text-white dark:focus:ring-purple-300">
                    {{ __('Iniciar Sesión') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
