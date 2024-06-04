<div class="bg-purple-100 p-6 rounded-lg shadow-lg pt-8 pb-4 mb-4 mt-0">
    <h1 class="text-xl font-semibold mb-4 ml-4">User #1</h1>

    <p class="text-gray-600 ml-8">ID: {{ $user->id }}</p>
    <p class="text-gray-600 ml-8">Name: {{ $user->name }}</p>
    <p class="text-gray-600 ml-8">Nickname: {{ $user->nickname }}</p>
    <p class="text-gray-600 ml-8">Email: {{ $user->email }}</p>
    <div class="mb-0 mr-4">
        <button class="bg-purple-700 hover:bg-purple-500 h-8 text-xs px-4 py-2 text-white font-bold mb-0 mt-4 ml-8 py-2 mr-4 mb-4 px-4 rounded">
            <a href="{{ route('users.edit', $user->id) }}">
                Edit
            </a>
        </button>
        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="deleteForm inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="deleteButton bg-black h-8 text-xs px-4 py-2 hover:bg-gray-700 text-white font-bold h-10 mr-8 mb-4 py-2 px-4 rounded">
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
