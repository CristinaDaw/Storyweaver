<section>
    <header>
        <h2 class="text-lg font-medium text-gray-100 dark:text-gray-100">
            {{ __('Modificar contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400 dark:text-gray-400">
            {{ __('Asegúrate de utilizar una contraseña segura para proteger tu cuenta.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update', ['user_id' => $user->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" class="text-white" :value="__('Contraseña actual')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full bg-gray-700 text-gray-300" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" class="text-white" :value="__('Nueva contraseña')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block bg-gray-700 w-full text-gray-300" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" class="text-white" :value="__('Confirmar contraseña')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block bg-gray-700 w-full text-gray-300" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gray-950">{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>
