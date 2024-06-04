<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
{{--            {{ __('Juegos') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

    <div class="py-4 h-[80%]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div id="errorMessage" class="alert alert-danger ml-24 mb-12 text-red-800 text-xs dark:text-green-200 font-semibold" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div id="successMessage" class="alert alert-danger ml-24 mb-12 text-green-800 text-xs dark:text-green-200 font-semibold" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @php
                $latestEventsView = app(\App\Http\Controllers\EventController::class)->indexLatest();
            @endphp

            {!! $latestEventsView !!}

                <form class="flex justify-end"action="{{ route('game.store') }}" method="post">
                    @csrf
                    <button type="submit" class="bg-purple-700 hover:bg-purple-500 h-8 text-xs px-4 py-2 text-white font-bold mt-8 ml-auto mr-12 rounded">
                        <i class="fas fa-plus"></i>
{{--                        {{ __("Nuevo juego") }}--}}
                    </button>
                </form>

                <div class="container mx-auto mt-4">
                    <div class="px-6 rounded-lg shadow-lg">
                        @if(auth()->user()->games->isEmpty())
                            <p class="text-gray-600 ml-8">No hay juegos disponibles todavía.</p>
                        @else
                            <ul>
                                @php
                                    $games = auth()->user()->games->sortByDesc('created_at');
                                @endphp

                                @if ($games)
                                    @foreach($games as $game)
                                        <div class="game-card hidden animate-pulse-fade-in bg-white p-6 dark:bg-purple-200 rounded-lg shadow-lg pt-4 mt-4">
                                            <h2 class="text-xl font-semibold mb-4">Aventura # {{ $loop->iteration }}</h2>

                                            @if ($game->character)
                                                <div id="card-game" class="flex ml-8 mr-8 bg-purple-100 p-6 rounded-lg shadow-lg pt-4 mt-4">
                                                    <div id="avatar_img" class="self-center w-32 h-32 mr-8 overflow-hidden rounded-full">
                                                        <img class="object-cover w-full h-full"  src="{{ $game->character->img_avatar }}"  alt="Avatar"/>
                                                    </div>
                                                    <div id="body-character">
                                                        <h2 class="text-l font-semibold mb-4">Personaje</h2>
                                                        <p class="text-xs text-gray-600">Nombre: {{ $game->character->name }}</p>
                                                        <p class="text-xs text-gray-600">Clase: {{ $game->character->class }}</p>
                                                        <p class="text-xs text-gray-600">Raza: {{ $game->character->race }}</p>
                                                        <p class="text-xs text-gray-600">Facción: {{ $game->character->faction }}</p>
                                                        <p class="text-xs text-gray-600">Trasfondo: {{ $game->character->background }}</p>
                                                        @if ($game->status == 'Finished')
                                                            <p class="mt-4 text-gray-800 font-semibold">ESTA AVENTURA HA FINALIZADO...</p>
                                                        @endif
                                                        <div id="character-buttons" class="mb-0 mr-4">
                                                            <button class="bg-purple-700 hover:bg-purple-500 text-white h-8 text-xs px-4 py-2 font-bold mb-0 mt-4 ml-auto mr-4 rounded">
                                                                <a href="{{ route('character.edit', $game->character->id) }}">
                                                                    Editar
                                                                </a>
                                                            </button>
                                                            <form id="deleteForm" action="{{ route('character.destroy', $game->character->id) }}" method="post" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="deleteButton h-8 text-xs px-4 py-2 bg-black hover:bg-gray-700 text-white font-bold ml-auto mr-8 rounded">
                                                                    Eliminar
                                                                </button>
                                                                <input type="hidden" id="password" name="password">
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="ml-8 text-gray-600">No hay ningún personaje para esta aventura todavía.</p>
                                            @endif


                                            <div class="flex flex-row justify-end items-center mt-6 mr-6">
                                                @if (!$game->character)
                                                    <button class="bg-purple-700 text-white font-bold mb-4 mr-4 ml-8 px-4 py-2 rounded hover:bg-purple-500">
                                                        <a href="{{ route('character.create', $game->id) }}">
                                                            Añadir personaje
                                                        </a>
                                                    </button>
                                                @endif

                                                @if ($game->status == 'Active' && $game->character)
                                                    <form action="{{ route('game.resume', ['game_id' => $game->id]) }}" method="get" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-purple-700 h-8 text-xs px-4 py-2 text-white font-bold rounded ml-2 hover:bg-purple-500">
                                                            Continuar
                                                        </button>
                                                    </form>
                                                @endif
                                                    <div x-data="{ isOpen: false }" @click.away="isOpen = false" class="relative inline-block items-center justify-center">
                                                        <button @click="isOpen = !isOpen" class="text-gray-600 focus:outline-none flex items-center justify-center">
                                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="0 0 24 24" version="1.1">
                                                                <title>Kebab-Menu</title>
                                                                <g id="Kebab-Menu" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect id="Container" x="0" y="0" width="24" height="24">

                                                                    </rect>
                                                                    <path d="M12,6 C12.5522847,6 13,5.55228475 13,5 C13,4.44771525 12.5522847,4 12,4 C11.4477153,4 11,4.44771525 11,5 C11,5.55228475 11.4477153,6 12,6 Z" id="shape-03" stroke="#4b5563" stroke-width="2" stroke-linecap="round" stroke-dasharray="0,0">

                                                                    </path>
                                                                    <path d="M12,13 C12.5522847,13 13,12.5522847 13,12 C13,11.4477153 12.5522847,11 12,11 C11.4477153,11 11,11.4477153 11,12 C11,12.5522847 11.4477153,13 12,13 Z" id="shape-03" stroke="#4b5563" stroke-width="2" stroke-linecap="round" stroke-dasharray="0,0">

                                                                    </path>
                                                                    <path d="M12,20 C12.5522847,20 13,19.5522847 13,19 C13,18.4477153 12.5522847,18 12,18 C11.4477153,18 11,18.4477153 11,19 C11,19.5522847 11.4477153,20 12,20 Z" id="shape-03" stroke="#4b5563" stroke-width="2" stroke-linecap="round" stroke-dasharray="0,0">

                                                                    </path>
                                                                </g>
                                                            </svg>
                                                        </button>
                                                        <div x-show="isOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                                            @if ($game->status == 'Active' && $game->character)
                                                                <form action="{{ route('game.finish', ['game_id' => $game->id]) }}" method="post" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit">
                                                                        Finalizar
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            <form id="deleteForm" action="{{ route('game.destroy', $game->id) }}" method="post" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit">
                                                                    Eliminar
                                                                </button>
                                                                <input type="hidden" id="password" name="password">
                                                            </form>
                                                        </div>
                                                    </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endif

                            </ul>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
<script>
    // Para mostrar mensaje error un lapso de tiempo X
    document.addEventListener('DOMContentLoaded', function() {
        const messageDiv = document.getElementById('errorMessage');
        messageDiv.classList.remove('hidden');
        setTimeout(function() {
            messageDiv.classList.add('hidden');
        }, 3000); // 3 segundos
    });

    document.addEventListener('DOMContentLoaded', function() {
        const messageDiv = document.getElementById('successMessage');
        messageDiv.classList.remove('hidden');
        setTimeout(function() {
            messageDiv.classList.add('hidden');
        }, 3000); // 3 segundos
    });

    const gameCards = document.querySelectorAll('.game-card');
    gameCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.remove('hidden')
        }, index * 800); // Ajusta el tiempo de retraso según sea necesario (200ms en este ejemplo)
    });


    // Obtenemo todos los botones de eliminación con la misma clase
    var deleteButtons = document.querySelectorAll('.deleteButton');

    // Agrega un event listener a cada botón de eliminación
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            var userInput = prompt('To confirm deletion, please type "DELETE":');
            if (userInput !== null && userInput.trim().toUpperCase() === 'DELETE') {
                // Busca el formulario asociado al botón de eliminación actual
                var form = button.closest('form');
                if (form) {
                    form.submit();
                } else {
                    console.error('Form not found');
                }
            } else {
                alert('Invalid input. Deletion cancelled.');
                event.preventDefault(); // Bloquea el envío del formulario
            }
        });
    });
</script>
