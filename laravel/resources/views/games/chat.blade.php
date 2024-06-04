<x-app-layout>
    <div id="chat-wrapper" class="container flex flex-col justify-between px-6 md:mx-auto gap-0 h-full md:mt-8 md:gap-10 flex-1">
        <!-- Caja principal del chat -->
        <div id="message-box" class="flex flex-col bg-transparent rounded-lg p-4 overflow-y-auto custom-scrollbar" style="min-height: 50vh; max-height: 50vh;">
            <!-- Aquí irían los mensajes del chat -->
        </div>
        <!-- Caja de inputs del chat -->
        <div id="chat-input-box" class="border-t-2 border-purple-400 px-4 pt-4 mb-2 sm:mb-0 flex-shrink-0" style="flex: 0 1 40%;">
            <!-- Toggle para seleccionar el tipo de prompt -->
            <div class="mb-4 w-full md:w-56 flex flex-col md:flex-row items-center">
                <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-purple-800 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option selected>Selecciona un tipo de acción: </option>
                    <option value="Conversation">Conversación</option>
                    <option value="Action">Acción</option>
                    <option value="Thought">Pensamiento</option>
                    <option value="More">Cuéntame más</option>
                </select>
            </div>
            <div class="relative flex">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <button type="button" class="inline-flex items-center justify-center rounded-full h-12 w-12 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                </svg>
                            </button>
                        </span>
                <input id="message-input" type="text" placeholder="Escribe un mensaje!" class="w-full focus:ring-1 focus:ring-purple-700 focus:outline-none focus:border-0 focus:placeholder-gray-400 dark:text-gray-100 placeholder-gray-600 pl-12 bg-gray-800 border-0 rounded-lg py-3">
                <div class="absolute right-0 items-center inset-y-0 hidden sm:flex space-x-2">
                    <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                    <button type="button" class="inline-flex items-center justify-center rounded-full h-10 w-10 transition duration-500 ease-in-out text-gray-500 hover:bg-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6 text-gray-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </button>
                    <button id="send-button" type="button" class="inline-flex items-center justify-center rounded-lg px-4 py-3 transition duration-500 ease-in-out text-white bg-purple-800 hover:bg-purple-400 focus:outline-none">
                        <span class="font-bold">Enviar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 ml-2 transform rotate-90">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="container-modal" class="fixed top-0 left-0 bg-black bg-opacity-75 justify-center items-center hidden">
        <img id="md-image" src="" alt="Modal Image" class="mx-auto rounded-lg">
        <button id="close-modal" class="absolute top-4 right-4 text-white text-lg focus:outline-none">&times;</button>
    </div>
    @if (!empty($game->context))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const messageBox = document.getElementById('message-box');

                // Crear el div contenedor del mensaje
                const messageContainer = document.createElement('div');
                messageContainer.id = 'message-container';
                messageContainer.classList.add('mt-8','mb-4', 'flex', 'flex-row-reverse', 'justify-center', 'items-center');

                // Crear el párrafo para el texto del mensaje
                const messageParagraph = document.createElement('div');
                messageParagraph.classList.add('ml-8', 'text-xs', 'dark:text-white', 'mr-8');
                messageParagraph.innerText = "{{ $game->context }}";

                // Agregar el párrafo al div contenedor
                messageContainer.appendChild(messageParagraph);

                // Agregar el div contenedor al mensaje principal
                messageBox.appendChild(messageContainer);
            });
        </script>
    @endif
    @if (empty($game->context))
        <script>
            function persistContext(data) {

                fetch('{{ route('api.persist-context') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ context: data.context, game_id: '{{ $game->id }}' })
                })
                    .then(response => response.json())
                    .then(responseData => {

                        const messageBox = document.getElementById('message-box');

                        // Crear el div contenedor del mensaje
                        const messageContainer = document.createElement('div');
                        messageContainer.classList.add('mb-4', 'flex', 'flex-row-reverse', 'justify-center', 'items-center');

                        // Crear el párrafo para el texto del mensaje
                        const messageParagraph = document.createElement('div');
                        messageParagraph.id='message-container';
                        messageParagraph.classList.add('ml-16', 'text-xs', 'dark:text-white', 'mr-8');
                        messageParagraph.innerText = responseData.context;

                        // Agregar el párrafo y la imagen al div contenedor
                        messageContainer.appendChild(messageParagraph);

                        // Agregar el div contenedor al mensaje principal
                        messageBox.appendChild(messageContainer);
                    })
                    .catch(e => console.log(e));
            }

            document.addEventListener('DOMContentLoaded', function () {
                fetchFirstShotChat();
            });

            function fetchFirstShotChat() {

                fetch('http://127.0.0.1:5000/api/first_shot_chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        character: {!! json_encode($game->character) !!}
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        persistContext(data);
                    })
                    .catch(e => console.log(e));
            }
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const gameId = {!! json_encode($game->id) !!};

            // Verificar si hay resultados en la base de datos ChatHistory para el juego actual
            fetch('{{ route('api.chat-history', ['game_id' => $game->id]) }}')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        // Recorrer los resultados y mostrarlos en el message-box
                        data.forEach(chat => {
                            if (chat.message.startsWith('Player: ')) {
                                let message = chat.message.replace('Player: ', '');
                                message = message.replace(/^(Though|Action|Conversation|More): /, '');
                                displayMessage(message);
                            }
                            if (chat.response.startsWith('Master AI: ')) {
                                // Remover la parte 'Master AI: ' del mensaje
                                const response = chat.response.replace('Master AI: ', '');
                                const image_url = chat.image_url
                                const image_id = displayResponse({response: response, image_url: image_url});
                                displayImage(image_url, image_id)

                            }
                        });
                    }
                })
                .catch(error => console.error('Error al obtener el historial del chat:', error));
        });
    </script>
    <script>
        function createLoadingSpinner() {
            const loadingIndicator = document.createElement('div');
            loadingIndicator.id = 'loading-indicator';
            loadingIndicator.className = 'hidden flex justify-self-center h-32 py-10 self-center';
            loadingIndicator.innerHTML = `<l-mirage size="150" speed="2.5" color="#7d13ff" ></l-mirage>`;
            return loadingIndicator;
        }

        // document.addEventListener('DOMContentLoaded', () => {
        //     const spinnerContainer = document.getElementById('spinner-container');
        //     spinnerContainer.appendChild(createLoadingSpinner());
        // });

        function displayMessage(message) {
            // Crear elementos HTML para mostrar el mensaje ingresado por el usuario
            const messageContainer = document.getElementById('message-box');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'mb-4 flex flex-row-reverse justify-start items-center';

            const messageContentDiv = document.createElement('div');
            messageContentDiv.className = 'flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start';

            const messageTextSpan = document.createElement('span');
            messageTextSpan.className = 'px-4 py-2 rounded-lg inline-block rounded-br-none bg-purple-800 text-white';
            messageTextSpan.textContent = message;

            const avatarImg = document.createElement('img');
            @if ($game->character->img_avatar)
                avatarImg.src = '{!! $game->character->img_avatar !!}';
            @else
                avatarImg.src = '{{ asset("img/avatar1.jpg") }}';
            @endif
            avatarImg.alt = 'Avatar';
            avatarImg.className = 'rounded-full object-cover w-8 h-8';

            // Adjuntar elementos al contenedor de mensajes
            messageContentDiv.appendChild(messageTextSpan);
            messageDiv.appendChild(messageContentDiv);
            messageDiv.appendChild(avatarImg);
            messageContainer.appendChild(messageDiv);

            const loadingIndicator = document.getElementById('loading-indicator');
            if (loadingIndicator) {
                loadingIndicator.remove();
            }
            messageContainer.appendChild(createLoadingSpinner());
            setTimeout(() => {
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }, 100);
        }

        function typeEffect(element, text, speed) {
            let i = 0;

            function typing() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(typing, speed);
                }
            }

            typing();
        }

        function displayResponse(responseData) {
            // Crear elementos HTML para mostrar la respuesta recibida del servidor
            const messageContainer = document.getElementById('message-box');
            const responseDiv = document.createElement('div');
            responseDiv.id = 'message-container'
            responseDiv.className = 'mb-4 flex flex-row-reverse justify-center items-center';

            const responseContentDiv = document.createElement('div');
            responseContentDiv.className = 'ml-8 w-[100%] text-xs dark:text-white mr-8';

            responseContentDiv.textContent = responseData.response;

            // Crear un contenedor de imagen con fondo negro
            const imageContainerDiv = document.createElement('div');
            imageContainerDiv.className = 'illustration rounded-lg m-8 border-solid border-gray-900 outline-none w-24 h-24 flex justify-center items-center border-none bg-gray-900 p-0'
            imageContainerDiv.id = 'image-container-' + Date.now();
            imageContainerDiv.backgroundImage = "url('../img/loading-image.jpg')";

            // Guardar el ID único para que displayImage pueda encontrar el contenedor más tarde
            responseData.imageContainerId = imageContainerDiv.id;

            const loadingIndicator = document.getElementById('loading-indicator');
            if (loadingIndicator) {
                loadingIndicator.remove();
            }

            // Adjuntar elementos al contenedor de mensajes
            responseDiv.appendChild(responseContentDiv);
            responseDiv.appendChild(imageContainerDiv);
            messageContainer.appendChild(responseDiv);

            messageContainer.scrollTop = messageContainer.scrollHeight;

            // Devolver el ID del contenedor de imagen para usarlo en displayImage
            return responseData.imageContainerId;
        }

        function displayResponseTyping(responseData) {
            // Crear elementos HTML para mostrar la respuesta recibida del servidor
            const messageContainer = document.getElementById('message-box');
            const responseDiv = document.createElement('div');
            responseDiv.id = 'message-container'
            responseDiv.className = 'mb-4 flex flex-row-reverse justify-center items-center';

            const responseContentDiv = document.createElement('div');
            responseContentDiv.className = 'ml-8 w-[100%] text-xs dark:text-white mr-8';

            typeEffect(responseContentDiv, responseData.response, 20)

            // Crear un contenedor de imagen con fondo negro
            const imageContainerDiv = document.createElement('div');
            imageContainerDiv.className = 'illustration rounded-lg m-8 border-solid border-gray-900 outline-none w-24 h-24 flex justify-center items-center border-none bg-gray-900 p-0'
            imageContainerDiv.id = 'image-container-' + Date.now();
            imageContainerDiv.backgroundImage = "url('../img/loading-image.jpg')";

            // Guardar el ID único para que displayImage pueda encontrar el contenedor más tarde
            responseData.imageContainerId = imageContainerDiv.id;

            const loadingIndicator = document.getElementById('loading-indicator');
            if (loadingIndicator) {
                loadingIndicator.remove();
            }

            // Adjuntar elementos al contenedor de mensajes
            responseDiv.appendChild(responseContentDiv);
            responseDiv.appendChild(imageContainerDiv);
            messageContainer.appendChild(responseDiv);

            messageContainer.scrollTop = messageContainer.scrollHeight;

            // Devolver el ID del contenedor de imagen para usarlo en displayImage
            return responseData.imageContainerId;
        }

        function fadeIn(element) {
            var opacity = 0;
            var intervalID = setInterval(function() {
                if (opacity < 1) {
                    opacity += 0.2;
                    element.style.opacity = opacity;
                } else {
                    clearInterval(intervalID);
                }
            }, 120);
        }

        function displayImage(image_url, imageContainerId) {
            const imageContainer = document.getElementById(imageContainerId);
            if (imageContainer) {
                // Aplicar las clases de TailwindCSS para el efecto fade-in
                imageContainer.style.backgroundImage = `url(${image_url})`;
                imageContainer.style.backgroundSize = 'cover';
                imageContainer.style.backgroundPosition = 'center';
                imageContainer.style.backgroundRepeat = 'no-repeat';
                imageContainer.classList.add('opacity-0');

                const imageElement = new Image();
                imageElement.onload = function() {
                    // Cuando la imagen principal se haya cargado, configurar como fondo
                    imageContainer.style.backgroundImage = `url(${image_url})`;
                    // Iniciar el efecto fade-in
                    fadeIn(imageContainer);
                };
                imageElement.onerror = function() {
                    console.error('Error al cargar la imagen:', image_url);
                };
                // Establecer la URL de la imagen principal para comenzar la carga
                imageElement.src = image_url;
            } else {
                console.error('No se encontró el contenedor de imagen con el ID:', imageContainerId);
            }
        }

        function sendMessage() {
            const game_id = {!! json_encode($game->id) !!};
            const characterData = {!! json_encode($game->character) !!};
            const message = document.getElementById('message-input').value.trim();
            const actionToggle = document.getElementById('underline_select');
            const actionType = actionToggle.value ? actionToggle.value : 'Action';
            var responseMaster = "";

            if (message !== '') {
                displayMessage(message);
                const loadingIndicator = document.getElementById('loading-indicator');
                loadingIndicator.classList.remove('hidden');
                console.log('{{ $game->context }}');

                fetch('{{ route('api.send-message') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        game_id: game_id,
                        character: characterData,
                        message: actionType + ': ' + message,
                        context: '{{ $game->context }}'
                    }),
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        console.log('Response status:', response.status);
                        return response.json(); // Parsear la respuesta como JSON
                    })
                    .then(responseData => {
                        responseMaster = responseData.response;
                        const responseText = responseData.response;
                        const image_id = displayResponseTyping(responseData);

                        // Almacenar el resumen de la conversación
                        return fetch('{{ route('conversation_summary.store', $game->id) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ summary: responseData.summary })
                        })
                            .then(summaryResponse => {
                                if (!summaryResponse.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return summaryResponse.json();
                            })
                            .then((data) => {
                                // Llamar al endpoint para generar la imagen
                                return fetch('{{ route('api.generate-image') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({ response_text: responseMaster, game_id: {{$game->id}} })
                                });
                            })
                            .then(imageResponse => {
                                if (!imageResponse.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return imageResponse.json();
                            })
                            .then(imageData => {
                                displayImage(imageData.image_url, image_id);
                            });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                    // .finally(() => {
                    //     loadingIndicator.classList.add('hidden');
                    // });

                document.getElementById('message-input').value = '';
            } else {
                alert('Por favor, introduce un mensaje válido.');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const messageInput = document.getElementById('message-input');

            // Event listener para detectar la pulsación de la tecla "Enter"
            messageInput.addEventListener('keypress', function(event) {
                // Verificar si la tecla presionada es "Enter"
                if (event.key === 'Enter') {
                    // Prevenir el comportamiento predeterminado del "Enter" en un input de texto
                    event.preventDefault();

                    // Llamar a la función sendMessage() cuando se presiona "Enter"
                    sendMessage();
                }
            });

            const sendButton = document.getElementById('send-button');

            sendButton.addEventListener('click', sendMessage)
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('container-modal');
            const image = document.getElementById('md-image');
            const closeModalButton = document.getElementById('close-modal');

            // Agregar evento click al contenedor de ilustraciones
            const illustrationsContainer = document.getElementById('message-box');
            illustrationsContainer.addEventListener('click', function (event) {
                // Verificar si el objetivo del evento es una imagen
                if (event.target.classList.contains('illustration')) {
                    // Obtener la URL de la imagen y mostrar el modal
                    const imageUrl = event.target.src;
                    image.src = imageUrl;
                    container.classList.remove('hidden');
                }
            });

            // Función para cerrar el modal
            closeModalButton.addEventListener('click', function () {
                container.classList.add('hidden');
            })
        });

        document.addEventListener('DOMContentLoaded', function () {
            const underlineSelect = document.getElementById('underline_select');
            const messageInput = document.getElementById('message-input');
            const sendButton = document.getElementById('send-button');

            messageInput.disabled = true;

            underlineSelect.addEventListener('change', function () {
                const selectedOption = underlineSelect.value;
                if (selectedOption !== 'More') {
                    messageInput.disabled = false;
                } else {
                    messageInput.disabled = true;
                }
            });

            sendButton.addEventListener('click', function () {
                const message = messageInput.value.trim();
                const selectedOption = underlineSelect.value;

                if (selectedOption !== 'More') {
                    if (message !== '') {
                        sendMessage(selectedOption, message);
                        messageInput.value = ''; // Limpiar el input después de enviar el mensaje
                    } else {
                        alert("Introduzca un mensaje válido.")
                    }
                } else {
                    sendMessage(selectedOption, "");
                }
            });

        document.addEventListener('DOMContentLoaded', function () {
            const promptToggle = document.getElementById('underline-select');
            const messageInput = document.getElementById('message-input');
            const sendButton = document.getElementById('send-button');


            // Enviar mensaje al hacer clic en el botón de enviar
            sendButton.addEventListener('click', function () {
                const message = messageInput.value.trim();
                if (message !== '') {
                    const selectedOption = promptToggle.value;
                    sendMessage(selectedOption, message);
                    messageInput.value = ''; // Limpiar el input después de enviar el mensaje
                }
            })
        });


        document.addEventListener('DOMContentLoaded', function () {
            // Elemento contenedor del chat
            const chatContainer = document.querySelector('.custom-scrollbar');
            const messageBox = document.querySelector('#message-box');
            let messages = document.querySelectorAll('#message-container');

            // Marcar el último mensaje como seleccionado
            messages[messages.length - 1].classList.add('selected');

            // Hacer scroll hacia abajo al cargar la página
            chatContainer.scrollTop = chatContainer.scrollHeight;
        })

    });


    </script>
</x-app-layout>
