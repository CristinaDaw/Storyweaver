<div class="animate-pulse-fade-in bg-purple-100 p-6 rounded-lg pb-0 shadow-lg pt-8 pb-4 mb-4 mt-0">
    <h1 class="text-xl font-semibold mb-4 ml-4">Character #1</h1>

    @php
        $game = $character->game;
    @endphp

    <p class="text-gray-600 ml-8">ID: {{ $character->id }}</p>
    <p class="text-gray-600 ml-8">Name: {{ $character->name }}</p>
    <p class="text-gray-600 ml-8">Class: {{ $character->class }}</p>
    <p class="text-gray-600 ml-8">Race: {{ $character->race }}</p>
    <p class="text-gray-600 ml-8">Faction: {{ $character->faction }}</p>
    <p class="text-gray-600 ml-8">Background: {{ $character->background }}</p>

    <div class="mb-0 mr-4">

        <form action="{{ route('character.destroy', $character->id) }}" method="post" class="deleteForm inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="deleteButton bg-black hover:bg-gray-700 text-white font-bold mt-4 ml-8 py-2 mr-4 mb-4 px-4 rounded">
                Delete
            </button>
        </form>
    </div>
</div>

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
</script>
