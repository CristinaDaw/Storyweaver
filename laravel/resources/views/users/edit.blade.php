<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('User #:user_id', ['user_id' => $user_id])  }}
                    </h2>
            
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Update this user profile information and email address.") }}
                    </p>
                </header>
                            
            
                <form method="post" action="{{ route('users.update', $user_id) }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
            
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="" autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="nickname" :value="__('Nickname')" />
                        <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" value="" autofocus autocomplete="nickname" />
                        <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
                    </div>
            
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="" autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />            
                        
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" value="" autofocus autocomplete="password" />
                        <x-input-error class="mt-2" :messages="$errors->get('password')" />
                    </div>
            
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
            
                        @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
