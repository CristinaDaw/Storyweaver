<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usage Guide - Storyweaver</title>
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <link href="{{ asset('css/howto.css') }}" rel="stylesheet">

    </head>
    <body class="bg-gray-900 flex-col min-h-screen justify-between h-screen">
        <nav class="bg-transparent h-20 p-4 flex justify-between items-center xs:flex-col">
            <a id="logo-welcome"  href="{{ route('welcome') }}" class="ml-14">
                <img src="{{ asset("img/Isotipo-white.png") }}" class="w-10 h-10" alt="Isologo-white">
            </a>
        </nav>
        <div id="wrapper-guest" class="flex flex-col h-3/5 w-full justify-around bg-cover bg-top bg-no-repeat md:bg-right-top md:h-5/6 sm:bg-right-top xs:bg-right-top 2xs:bg-right-top">
            <!-- Hero -->
            <section
                class="flex flex-wrap items-center font-sans px-4 mx-auto w-full lg:max-w-screen-lg sm:max-w-screen-sm md:max-w-screen-md pb-20">
                <!-- Column-1 -->
                <div class="px-3 w-full lg:w-2/5">
                    <div
                        class="mx-auto mb-8 max-w-lg text-center lg:mx-0 lg:max-w-md lg:text-left">
                        <h2 class="mb-4 text-3xl font-bold text-left lg:text-5xl dark:text-white">
                            Genera tu propia

                            <span class="text-5xl text-purple-500 leading-relaxed"
                            >Aventura
                            </span>

                            gracias a la IA
                        </h2>

                        <p
                            class="visible mx-0 mt-3 mb-0 text-sm leading-relaxed text-left text-slate-400">
                            Reinventamos el storytelling. Historias transformadas por el poder de la IA.
                        </p>
                    </div>

                    <div class="text-center lg:text-left">
                        <a
                            class="block visible py-4 px-8 mb-4 text-xs font-semibold tracking-wide leading-none text-white bg-purple-500 rounded cursor-pointer sm:mr-3 sm:mb-0 sm:inline-block"
                        >Características clave</a
                        >

                        <a
                            class="block visible py-4 px-8 text-xs font-semibold leading-none bg-white rounded border border-solid cursor-pointer sm:inline-block border-slate-200 text-slate-500"
                        >Cómo trabajamos?</a
                        >
                    </div>
                </div>

                <!-- Column-2 -->
                <div class="px-3 mb-12 w-full lg:mb-0 lg:w-3/5">
                    <!-- Illustrations Container -->
                    <div class="flex justify-center items-center">
                        <img src="{{ asset('../img/guide-draconian.png') }}" />
                    </div>
                </div>
            </section>

            <!-- Parallax Background -->
            <section
                class="flex flex-col w-full h-[500px] bg-cover bg-fixed bg-center flex justify-center items-center"
                style="
                    background-image: url({{ asset('../img/d20dice.jpg') }});
                ">
                <h1 class="text-white text-5xl font-semibold mt-20 mb-10">
                    Recursos Utilizados
                </h1>

                <span class="text-center font-bold my-20 text-white/90">
                    <a
                        href="https://platform.openai.com/docs/models/gpt-3-5-turbo"
                        target="_blank"
                        class="text-white/90 hover:text-white">
                        Modelo de lenguaje
                    </a>

                    <hr class="my-4" />

                    <a
                        href="https://platform.openai.com/docs/models/dall-e"
                        target="_blank"
                        class="text-white/90 hover:text-white">
                        Modelo de Generación de Imágenes
                    </a>

                    <hr class="my-4" />

                    <p>
                        <a
                            href="https://github.com/CristinaDaw/apiSW/tree/tfg-development"
                            target="_blank"
                            class="text-white/90 hover:text-white">
                            Core App
                        </a>
                         |

                        <a
                            href="https://github.com/CristinaDaw/apiPythonSW"
                            target="_blank"
                            class="text-white/90 hover:text-white">
                            Python Service
                        </a>
                    </p>
                </span>
            </section>

            <!-- Content -->
            <section class="p-20 space-y-8">
                <h1 class="text-5xl dark:text-white font-semibold text-center my-20">Empezar a jugar</h1>
                <div id="Guideline-wrapper" class="flex flex-col justify-between items-center">
                    <h2 class="text-2xl dark:text-white self-start mt-14 mb-8">Paso 1: Regístrate en Storyweaver</h2>
                    <p class="dark:text-white mb-12">
                        Desde la HOME PAGE dirígete a la esquina superior derecha y pulsa sobre el botón de 'Regístrate'.
                        Una vez hecho esto se te redirigirá a una vista con un formulario de registro. Deberás rellenar
                        todos los campos requeridos en este formulario sin excepción así como aceptar los
                        <a href="" class="text-purple-500">términos y
                        condiciones de nuestra página</a>. Una vez cumplimentados debidamente todos los campos pulsa en el
                        botón de 'Regístrate' y estarás debidamente registrado en Storyweaver.
                    </p>
                    <div class="flex flex-row gap-12 justify-center w-4/5">
                        <img src="{{ asset('../img/register.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-1"/>
                        <img src="{{ asset('../img/createAccount.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-2"/>
                    </div>
                </div>

                <div id="Guideline-wrapper" class="flex flex-col justify-between items-center">
                    <h2 class="text-2xl dark:text-white self-start mt-14 mb-8">Paso 2: Crear un juego</h2>
                    <p class="dark:text-white mb-12">
                        Cuando hayas terminado el registro de tu usuario se te redirigirá automáticamente al Panel de usuario
                        para tu cuenta. En éste deberías ver la relación de juegos que tienes tanto en curso como finalizados.
                        Si es la primera vez que accedes a Storyweaver no habrá ningún juego por lo que verás un mensaje indicativo
                        de esto. Para añadir un nuevo juego sencillamente pulsa sobre el icono de '+' dentro de tu Panel de usuario.
                    </p>
                    <div class="flex flex-row gap-12 justify-center w-4/5">
                        <img src="{{ asset('../img/guide-centaur.png') }}" class="h-72" alt="guideline-2"/>
                        <img src="{{ asset('../img/newGame.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-1"/>
                    </div>
                </div>

                <div id="Guideline-wrapper" class="flex flex-col justify-between items-center">
                    <h2 class="text-2xl dark:text-white self-start mt-14 mb-8">Paso 3: Creación de tu personaje</h2>
                    <p class="dark:text-white mb-12">
                        Una vez pulsado en el símbolo '+' se te redirigirá a un formulario de creación de personaje.
                        Nuevamente deberás rellenar todos los campos del formulario a fin de completar la configuración
                        de tu personaje para este juego concreto. También podrás aportar una url con la imagen
                        que desees para el avatar de tu personaje a fin de identificarlo rápidamente
                        cuando accedas al listado de juegos.
                    </p>
                    <div class="flex flex-row gap-12 justify-center w-4/5">
                        <img src="{{ asset('../img/characterCreate.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-1"/>
                        <img src="{{ asset('../img/guide-dragon.png') }}" class="h-72" alt="guideline-2"/>
                    </div>
                </div>

                <div id="Guideline-wrapper" class="flex flex-col justify-between items-center">
                    <h2 class="text-2xl dark:text-white self-start mt-14 mb-8">Paso 4: Empezar a jugar</h2>
                    <p class="dark:text-white mb-12">
                        Tras crear nuestro personaje seremos redirigidos nuevamente al Panel de usuario donde ahora sí
                        podremos ver la ficha de nuestro juego y su personaje mostrándose en el listado de juegos.
                        Ya estamos listos para comenzar nuestra aventura, y para ello simplemente debemos pulsar en
                        'Continuar' para ir a la ventana de chat del juego.
                    </p>
                    <div class="flex flex-row gap-12 justify-center w-4/5">
                        <img src="{{ asset('../img/continue.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-1"/>
                        <img src="{{ asset('../img/chat.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-2"/>
                    </div>
                </div>
                <div id="Guideline-wrapper" class="flex flex-col justify-between items-center">
                    <h2 class="text-2xl dark:text-white self-start mt-14 mb-8">Paso 5: Iniciar la conversación</h2>
                    <p class="dark:text-white mb-12">
                        Al acceder a la ventana de chat del juego veremos que nuestro Master impulsado por IA nos habrá
                        generado un mensaje de inicio de la partida con datos de nuestro personaje en él. A partir de
                        aquí será responsabilidad nuestra continuar la conversación. Para ello simplemente deberemos seleccionar
                        el tipo de acción que vamos a realizar, es decir, si vamos a ejecutar una acción, un diálogo
                        o si simplemente se trata de un pensamiento recorriendo la mente de nuestro personaje. Una vez
                        seleccionada, rellenaremos el cuerpo del mensaje propiamente dicho y enviaremos. Una vez enviado,
                        deberemos esperar unos segundos la respuesta de nuestro Master.
                    </p>
                    <div class="flex flex-row gap-12 justify-center w-4/5">
                        <img src="{{ asset('../img/message.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-1"/>
                        <img src="{{ asset('../img/waiting.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-2"/>
                    </div>
                </div>

                <div id="Guideline-wrapper" class="flex flex-col justify-between items-center">
                    <h2 class="text-2xl dark:text-white self-start mt-14 mb-8">Paso 6: Recibir respuesta</h2>
                    <p class="dark:text-white mb-12">
                        Transcurridos unos pocos segundos recibiremos por parte de nuestro Master una respuesta. Ésta
                        estará compuesta de un mensaje de texto con el propio contenido de la respuesta continuando
                        nuestra aventura y, además una imagen ilustrativa del propio mensaje generada por
                        inteligencia artificial.
                    </p>
                    <div class="flex flex-row gap-12 justify-center w-4/5">
                        <img src="{{ asset('../img/message.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-1"/>
                        <img src="{{ asset('../img/response.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-2"/>
                    </div>
                </div>

                <div id="Guideline-wrapper" class="flex flex-col justify-between items-center">
                    <h2 class="text-2xl dark:text-white self-start mt-14 mb-8">Paso 7: Finalizar un juego</h2>
                    <p class="dark:text-white mb-12">
                        En el panel de usuario, concretamente en la ficha de nuestro juego, encontraremos un pequeño
                        menú de puntos desplegable. En él podremos seleccionar: 'Finalizar' si consideramos que queremos
                        dar por finalizada nuestra aventura pero conservar los datos de la misma, ó 'Eliminar', si lo
                        que deseamos es eliminar completamente el juego y todos los datos asociados al mismo.
                    </p>
                    <div class="flex flex-row gap-12 justify-center w-4/5">
                        <img src="{{ asset('../img/guide-undead.png') }}" class="h-72" alt="guideline-2"/>
                        <img src="{{ asset('../img/delete.jpg') }}" class="h-64 rounded-md border-2 border-purple-800" alt="guideline-1"/>
                    </div>
                </div>
            </section>
            <!-- Footer -->
            <footer class="bg-gray-800 pt-10 sm:mt-10 pt-10 w-full">
                <div class="max-w-6xl m-auto text-gray-800 flex flex-wrap justify-left">
                    <!-- Col-1 -->
                    <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                        <!-- Col Title -->
                        <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                            Cómo empezar
                        </div>

                        <!-- Links -->
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Registro y autenticación
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Panel de usuario
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Flujo de juego
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Protección de datos
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Política de cookies
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Soporte técnico
                        </a>
                    </div>

                    <!-- Col-2 -->
                    <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                        <!-- Col Title -->
                        <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                            Guías de Uso
                        </div>

                        <!-- Links -->
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Guardar historial de juego
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Guardar configuración de personaje
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Desactivar la generación de imagen
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Configuración del modelo de lenguaje
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Configuración del modelo de genración de imagen
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Añadir utilidades adicionales
                        </a>
                    </div>

                    <!-- Col-3 -->
                    <div class="p-5 w-1/2 sm:w-4/12 md:w-3/12">
                        <!-- Col Title -->
                        <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                            Configuración
                        </div>

                        <!-- Links -->
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Configuración del juego
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Configuración de personaje
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Configuración de la cuenta
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Cambiar tema de la interfaz
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Gestión del modelo de suscripción
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Personalización de la factura
                        </a>
                    </div>

                    <!-- Col-3 -->
                    <div class="p-5 w-1/4 sm:w-4/12 md:w-3/12">
                        <!-- Col Title -->
                        <div class="text-xs uppercase text-gray-400 font-medium mb-6">
                            Comunidad
                        </div>

                        <!-- Links -->
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            GitHub
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Discord
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            Twitter
                        </a>
                        <a
                            href="#"
                            class="my-3 block text-gray-300 hover:text-gray-100 text-sm font-medium duration-700">
                            YouTube
                        </a>
                    </div>
                </div>

                <!-- Copyright Bar -->
                <div id="wrapper-copy-bar" class="pt-2">
                    <div
                        id="copy-bar"
                        class="flex pb-5 px-3 m-auto pt-5 border-t border-gray-500 text-gray-400 text-sm flex-col md:flex-row max-w-6xl">
                        <img src="{{ asset('img/TipografíaLogotipo.png') }}" alt="Logo" class="h-4 mt-2">
                        <div class="mt-2 w-3/5 text-center">&copy; 2024 Storyweaver. Todos los derechos reservados.</div>

                        <!-- Required Unicons (if you want) -->
                        <div class="md:flex-auto md:flex-row-reverse mt-2 flex-row flex">
                            <a href="#" class="w-6 h-6 mx-1">
                                <i class="uil uil-facebook-f"></i>
                            </a>
                            <a href="#" class="w-6 mx-1">
                                <i class="uil uil-twitter-alt"></i>
                            </a>
                            <a href="#" class="w-6 mx-1">
                                <i class="uil uil-youtube"></i>
                            </a>
                            <a href="#" class="w-6 mx-1">
                                <i class="uil uil-linkedin"></i>
                            </a>
                            <a href="#" class="w-6 mx-1">
                                <i class="uil uil-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- Hamburger Menu Icon -->
        <div id="burger-welcome" class="hidden">
            <button id="menu-toggle" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        @if (Route::has('login'))
            <div id="auth-menu" class="fixed top-0 right-0 px-6 py-2 sm:block mr-12 mt-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-xs font-sans font-bold text-white text-md hover:text-purple-700">Perfil</a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-sans font-bold mr-4 text-white text-md hover:text-purple-700">Acceder</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-xs font-sans font-bold text-white text-md hover:text-purple-700">Registrarse</a>
                    @endif
                @endauth
            </div>
        @endif
    </body>
</html>
