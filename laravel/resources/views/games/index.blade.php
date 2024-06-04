@php
    $games = $games->sortByDesc('updated_at');
@endphp

@foreach($games as $game)

    <div class="animate-pulse-fade-in hidden game-card bg-purple-100 p-6 rounded-lg pb-0 shadow-lg pt-8 pb-4 mb-4 mt-0">
        <h1 class="text-xl font-semibold mb-4 ml-4">Game #{{ $loop->iteration }}</h1>

        @php
            $user = $game->user;
        @endphp

        <p class="text-gray-600 ml-8">ID: {{ $game->id }}</p>
        <p class="text-gray-600 ml-8">Owner: {{ $user->name }}</p>
        <p class="text-gray-600 ml-8">Status: {{ $game->status }}</p>
        <p class="text-gray-600 ml-8">Last Updated: {{ $game->updated_at }}</p>
        @if ($game->status == 'Finished')
            <p class="mt-4 ml-8 text-gray-800 font-semibold">THIS GAME HAS ENDED.</p>
        @endif

        <div class="mb-0 mr-4">
            @if ($game->status == 'Active')
                <form action="{{ route('game.finish', ['game_id' => $game->id]) }}" method="post" class="inline ml-6">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="bg-purple-700 text-white font-bold px-4 py-2 rounded ml-2 hover:bg-purple-500">
                        Finish Game
                    </button>
                </form>
            @endif
            <form action="{{ route('game.destroy', $game->id) }}" method="post" class="deleteForm inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="deleteButton bg-black hover:bg-gray-700 text-white font-bold mt-4 ml-8 py-2 mr-4 mb-4 px-4 rounded">
                    Delete
                </button>
            </form>
        </div>
    </div>
@endforeach

<script>
    // Para validar eliminar
    var deleteButtons = document.getElementsByClassName('deleteButton');
    var deleteForms = document.getElementsByClassName('deleteForm');

    for (var i = 0; i < deleteButtons.length; i++) {
        deleteButtons[i].addEventListener('click', function(event) {
            var input = prompt('To confirm deletion, please type "DELETE":');
            if (input !== null && input.trim().toUpperCase() === 'DELETE') {
                event.target.closest('.deleteForm').submit();
            } else {
                alert('Invalid input. Deletion canceled.');
                event.preventDefault(); // Bloquea el envío del formulario
            }
        });
    }

    const gameCards = document.querySelectorAll('.game-card');
    gameCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.remove('hidden')
        }, index * 800); // Ajusta el tiempo de retraso según sea necesario (200ms en este ejemplo)
    });
</script>
