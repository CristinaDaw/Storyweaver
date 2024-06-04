<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('error'))
                <div id="errorMessage" class="alert alert-danger ml-24 mb-12 text-red-800 font-semibold" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div id="successMessage" class="alert alert-danger ml-24 mb-12 text-green-800 font-semibold" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @php
                $latestEventsView = app(\App\Http\Controllers\EventController::class)->indexLatest();
            @endphp

            {!! $latestEventsView !!}

            <div class="bg-purple-200 dark:bg-purple-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container bg-purple-200 mx-auto mt-8">
                    <div class="bg-purple-200 p-6 rounded-lg shadow-lg pt-0 mt-0">
                        <h1 class="text-3xl font-semibold mb-4 ml-4">Welcome Admin!</h1>

                        <p class="text-gray-600 ml-8">Role: {{ auth()->user()->roles->first()->name }}</p>
                        <p class="text-gray-600 ml-8">Name: {{ auth()->user()->name }}</p>
                        <p class="text-gray-600 ml-8">Nickname: {{ auth()->user()->nickname }}</p>
                        <p class="text-gray-600 ml-8">Email: {{ auth()->user()->email }}</p>

                    </div>
                </div>


                <div class="container mx-auto mt-4">
                    <div class="p-6 rounded-lg shadow-lg">
                        <h1 class="text-3xl font-semibold mb-4 ml-4 text-center">Administration Panel</h1>

                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold mb-4 ml-4">Users</h2>
                            <hr>
                            <div class="flex justify-end items-center mt-6">
                                <button onclick="searchUsers()" data-type="users" class="toggle-search bg-purple-700 text-white font-bold mb-4 mr-2 px-4 py-2 rounded hover:bg-purple-500">Search</button>
                                <input type="hidden" class="user-search rounded-lg bg-purple-100 text-gray-700 border-transparent px-4 mb-4 mr-2" placeholder="Search by name...">
                                <button onclick="listAllUsers()" class="listButton bg-purple-700 text-white font-bold mb-4 mr-2 px-4 py-2 rounded hover:bg-purple-500">List All</button>
                            </div>

                            <div id="user-container"></div>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold mb-4 ml-4">Games</h2>
                            <hr>
                            <div class="flex justify-end items-center mt-6">
                                <button onclick="searchGames()" data-type="games" class="toggle-search bg-purple-700 text-white font-bold mb-4 mr-2 px-4 py-2 rounded hover:bg-purple-500">Search</button>
                                <input type="hidden" class="game-search rounded-lg bg-purple-100 text-gray-700 border-transparent px-4 mb-4 mr-2" placeholder="Search by ID...">
                                <button onclick="listAllGames()" class="listButton bg-purple-700 text-white font-bold mb-4 mr-2 px-4 py-2 rounded hover:bg-purple-500">List All</button>
                            </div>

                            <div id="game-container"></div>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold mb-4 ml-4">Characters</h2>
                            <hr>
                            <div class="flex justify-end items-center mt-6">
                                <button onclick="searchCharacters()" data-type="characters" class="toggle-search bg-purple-700 text-white font-bold mb-4 mr-2 px-4 py-2 rounded hover:bg-purple-500">Search</button>
                                <input type="hidden" class="character-search rounded-lg bg-purple-100 text-gray-700 border-transparent px-4 mb-4 mr-2" placeholder="Search by name...">
                                <button onclick="listAllCharacters()" class="listButton bg-purple-700 text-white font-bold mb-4 mr-2 px-4 py-2 rounded hover:bg-purple-500">List All</button>
                            </div>

                            <div id="character-container"></div>
                        </div>

                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold mb-4 ml-4">Roles</h2>
                            <hr>
                            <div class="flex justify-end items-center mt-6">
                                <button onclick="searchRole()" data-type="roles" class="toggle-search bg-purple-700 text-white font-bold mb-4 mr-2 px-4 py-2 rounded hover:bg-purple-500">Search</button>
                                <input type="hidden" class="role-search rounded-lg bg-purple-100 text-gray-700 border-transparent px-4 mb-4 mr-2" placeholder="Search by ID...">
                                <button onclick="listAllRoles()" class="listButton bg-purple-700 text-white font-bold mb-4 mr-2 px-4 py-2 rounded hover:bg-purple-500">List All</button>
                            </div>

                            <div id="role-container"></div>
                        </div>


                    </div>


                </div>

            </div>

        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        // Función para manejar el clic default en los botones con la clase listButton
        function handleListButtonClick(event) {
            event.preventDefault(); // Detiene el comportamiento predeterminado del botón

            var button = event.target; //botón lanzador
            var action = button.getAttribute('data-action'); //action del botón lanzador
            switch(action){
                case 'listAllUsers':
                    listAllUsers();
                    break;

                case 'listAllGames':
                    listAllGames();
                    break;

                case 'listAllCharacters':
                    listAllCharacters();
                    break;

                case 'listAllRoles':
                    listAllRoles();
                    break;
            }
        }

        // Obtienes todos los botones con la clase listButton y agrega un event listener
        document.querySelectorAll('.listButton').forEach(button => {
            button.addEventListener('click', handleListButtonClick);
        });

        function listAllUsers() {

            var userContainer = document.getElementById('user-container');

            if (userContainer.innerHTML.trim() === '') {

                fetch('/users')
                    .then(response => response.text())
                    .then(html => {

                        userContainer.innerHTML = html;
                        // Evalúa el código JavaScript dentro del contenido HTML recién agregado
                        evalScripts(userContainer);
                    })
                    .catch(error => {
                        console.error('Error fetching users:', error);
                    });
            } else {
                userContainer.innerHTML = '';
            }
        }

        function listAllCharacters() {
            var characterContainer = document.getElementById('character-container');

            if (characterContainer.innerHTML.trim() === '') {
                fetch('/characters')
                    .then(response => response.text())
                    .then(html => {
                        characterContainer.innerHTML = html;
                        // Evalúa el código JavaScript dentro del contenido HTML recién agregado
                        evalScripts(characterContainer);
                    })
                    .catch(error => {
                        console.error('Error fetching characters:', error);
                    });
            } else {
                characterContainer.innerHTML = '';
            }
        }

        function listAllGames() {
            var gameContainer = document.getElementById('game-container');

            if (gameContainer.innerHTML.trim() === '') {
                fetch('/games')
                    .then(response => response.text())
                    .then(html => {
                        gameContainer.innerHTML = html;
                        // Evalúa el código JavaScript dentro del contenido HTML recién agregado
                        evalScripts(gameContainer);
                    })
                    .catch(error => {
                        console.error('Error fetching games:', error);
                    });
            } else {
                gameContainer.innerHTML = '';
            }
        }

        function listAllRoles() {
            var roleContainer = document.getElementById('role-container');

            if (roleContainer.innerHTML.trim() === '') {
                fetch('/roles')
                    .then(response => response.text())
                    .then(html => {
                        roleContainer.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error fetching roles:', error);
                    });
            } else {
                roleContainer.innerHTML = '';
            }
        }

        function evalScripts(container) {
            // Encuentra y ejecuta todos los scripts dentro del contenedor especificado
            var scripts = container.querySelectorAll('script');
            scripts.forEach(script => {
                if (script.src) {
                    // Si el script tiene un atributo "src", crea un nuevo elemento script y asigna la URL del atributo "src"
                    var newScript = document.createElement('script');
                    newScript.src = script.src;
                    document.body.appendChild(newScript);
                } else {
                    // Si el script no tiene un atributo "src", evalúa su contenido directamente
                    eval(script.textContent);
                }
            });
        }

    </script>
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





    document.querySelectorAll('.toggle-search').forEach(button => {
        button.addEventListener('click', function() {
            var searchInput = button.nextElementSibling;
            var type = button.getAttribute('data-type');

            if (searchInput.type === 'hidden') {
                searchInput.type = 'text';
            } else {
                searchInput.type = 'hidden';
                button.textContent = 'Search';
                search(type);
            }

            // Prevenir la acción por defecto del formulario
            event.preventDefault();
        });
    });

    function search(type) {
    var container;
    var url;

    switch (type) {
        case 'users':
            var searchTerm = document.querySelector('.user-search').value;

            container = document.getElementById('user-container');
            url = '/users/show/' + searchTerm;
            break;
        case 'games':
            var searchTerm = document.querySelector('.game-search').value;
            container = document.getElementById('game-container');
            url = '/games/show/' + searchTerm;
            break;
        case 'characters':
            var searchTerm = document.querySelector('.character-search').value;
            container = document.getElementById('character-container');
            url = '/characters/show/' + searchTerm;
            break;
        case 'roles':
            var searchTerm = document.querySelector('.role-search').value;
            container = document.getElementById('role-container');
            url = '/roles/show/' + searchTerm;
            break;
        default:
            console.error('Invalid search type:', type);
            return;
    }

    if (searchTerm === '') {
        return;
    } else{
        fetch(url)
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html;
            evalScripts(container);
        })
        .catch(error => {
            console.error('Error searching:', error);
        });

    }
    }
</script>


