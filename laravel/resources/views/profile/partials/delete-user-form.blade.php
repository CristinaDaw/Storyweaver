<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-100 dark:text-gray-100">
            {{ __('Eliminar cuenta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400 dark:text-gray-400">
            {{ __('Una vez su cuenta sea eliminada, tanto su configuración como sus datos serán eliminados permanentemente. Antes de eliminar su cuenta, asegúrese de hacer una copia de cualquier dato o información que desee salvaguardar.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Eliminar cuenta') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-100 dark:text-gray-100">
                {{ __('Está usted seguro de querer eliminar su cuenta?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400 dark:text-gray-400">
                {{ __('Una vez eliminada su cuenta, tanto su configuración como sus datos serán eliminados permanentemente. Por favor, introduzca su contraseña si desea eliminar permanentemente su cuenta.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Contraseña') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Contraseña') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Eliminar cuenta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
