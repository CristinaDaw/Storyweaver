<x-guest-layout>
    <form method="POST" action="{{ route('character.store') }}">
        @csrf

        <div class="mb-8 mt-4">
            <h2 class="font-semibold text-2xl text-center text-gray-800 dark:text-gray-200 leading-tight">
                Crear personaje
            </h2>
        </div>
        <!-- Avatar URL or Browse -->
        <x-input-label for="avatar" :value="__('Avatar')" />
        <div class="mb-4 flex items-center">
            <input id="avatar" type="text" name="img_avatar" class="block text-sm mt-1 w-full dark:bg-gray-900 rounded dark:text-white" placeholder="Introduce la URL de tu avatar...">

        </div>
        <!-- Name -->
        <input type="hidden" name="game_id" value="{{ request()->route('game_id') }}">
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="text-sm block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Lae'zel" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Class -->
        <div class="mt-4">
            <x-input-label for="class" :value="__('Clase')" />
            <select id="class" name="class" class="text-sm block mt-1 w-full form-select dark:bg-gray-900 rounded dark:text-white" required>
                <option value="" disabled selected>{{ __('Selecciona una clase') }}</option>
                <option value="Barbarian">Bárbaro</option>
                <option value="Bard">Bardo</option>
                <option value="Warlock">Brujo</option>
                <option value="Cleric">Clérigo</option>
                <option value="Druid">Druida</option>
                <option value="Ranger">Explorador</option>
                <option value="Fighter">Guerrero</option>
                <option value="Sorcerer">Hechicero</option>
                <option value="Wizard">Mago</option>
                <option value="Monk">Monje</option>
                <option value="Paladin">Paladín</option>
                <option value="Rogue">Pícaro</option>
            </select>
            <x-input-error :messages="$errors->get('class')" class="mt-2" />
        </div>

        <!-- Race -->
        <div class="mt-4">
            <x-input-label for="race" :value="__('Raza')" />
            <select id="race" name="race" class="text-sm block mt-1 w-full form-select dark:bg-gray-900 rounded dark:text-white" required>
                <option value="" disabled selected>Selecciona una raza</option>
                <option value="Dragonborn">Dracónido</option>
                <option value="Elf">Elfo</option>
                <option value="Dwarf">Enano</option>
                <option value="Gnome">Gnomo</option>
                <option value="Human">Humano</option>
                <option value="Halfling">Mediano</option>
                <option value="Half-Elf">Semielfo</option>
                <option value="Half-Orc">Semiorco</option>
                <option value="Tiefling">Tiefling</option>
            </select>
            <x-input-error :messages="$errors->get('race')" class="mt-2" />
        </div>

        <!-- Faction -->
        <div class="mt-4">
            <x-input-label for="faction" :value="__('Facción')" />
            <select id="faction" name="faction" class="text-sm block mt-1 w-full form-select dark:bg-gray-900 rounded dark:text-white" required>
                <option value="" disabled selected>Selecciona una facción</option>
                <option value="Harpers">Arpistas</option>
                <option value="Order of the Gauntlet">Orden del Guantelete</option>
                <option value="Emerald Enclave">Enclave Esmeralda</option>
                <option value="Lords Alliance">Alianza de los Señores</option>
                <option value="Zhentarim">Zhentarim</option>
            </select>
            <x-input-error :messages="$errors->get('faction')" class="mt-2" />
        </div>

        <!-- Background -->
        <div class="mt-4">
            <x-input-label for="background" :value="__('Trasfondo')" />

            <textarea
                id="background"
                name="background"
                rows="4"
                maxlength="360"
                placeholder="Inserta aquí algunos detalles sobre tu personaje y su trasfondo..."
                class="block mt-1 w-full h-16 form-input text-sm rounded-md shadow-sm dark:bg-gray-900 dark:text-white"
                required
            ></textarea>

            <x-input-error :messages="$errors->get('background')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Crear') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
