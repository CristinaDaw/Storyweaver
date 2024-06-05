<x-guest-layout>
   <div class="p-2 space-y-4 md:space-y-6 sm:p-4">
        <h1 class="text-xl text-white font-bold leading-tight tracking-tight dark:text-white">
            Crea una cuenta
        </h1>
        <form method="POST" action="{{ route('register') }}" class="space-y-2 md:space-y-4">
            @csrf
            <!-- Name -->
            <div>
                <label for="name" class="block mb-2 text-xs font-medium text-white dark:text-white">Nombre</label>
                <x-text-input id="name" class=" text-gray-300 border border-gray-300
                sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="name" :value="old('name')" required placeholder="Paul Smith" autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Nickname -->
            <div>
                <label for="nickname" class="block mb-2 text-xs font-medium text-white dark:text-white">Apodo</label>
                <x-text-input id="nickname" class=" border border-gray-300  text-gray-300 sm:text-sm
                rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="nickname" :value="old('nickname')" placeholder="paul94" required autofocus />
                <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block mb-2 text-xs font-medium text-white dark:text-white">Correo Electrónico</label>
                <x-text-input id="email" class="border border-gray-300  text-gray-300
                sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="email" name="email" :value="old('email')" required placeholder="name@company.com" autofocus autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-xs font-medium text-white dark:text-white">Contraseña</label>
                <x-text-input id="password" class="bg-gray-700 border border-gray-300  text-gray-300 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="password" placeholder="••••••••" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block mb-2 text-xs font-medium text-white dark:text-white">Confirmar Contraseña</label>
                <x-text-input id="password_confirmation" class="bg-gray-700 border border-gray-300  text-gray-300
                 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="password" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                </div>
                <div class="ml-3 text-xs">
                    <label for="terms" class="font-light text-gray-500 dark:text-gray-300">Acepto los <a class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">Términos y Condiciones</a></label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3 text-white px-auto text-center bg-gray-950 hover:bg-purple-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm dark:bg-purple-300 dark:hover:bg-purple-900 dark:hover:text-white dark:focus:ring-purple-950">
                    {{ __('Regístrate') }}
                </x-primary-button>
            </div>

            <!-- Login Link -->
            <p class="text-xs font-light text-gray-500 dark:text-gray-400 mt-2">
                ¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Iniciar sesión</a>
            </p>
        </form>
    </div>
</x-guest-layout>
