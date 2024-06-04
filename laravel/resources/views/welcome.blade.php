<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HOME - Storyweaver</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/Isotipo-white.png') }}">
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    </head>
    <body class="bg-gray-900 flex-col min-h-screen justify-between h-screen">
        <nav class="bg-transparent h-20 p-4 flex justify-between items-center xs:flex-col">
            <a id="logo-welcome" href="{{ route('welcome') }}" class="ml-14">
                <img src="{{ asset("img/Isotipo-white.png") }}" class="w-10 h-10" alt="Isologo-white">
            </a>
        </nav>
        <div id="wrapper-welcome" class="flex flex-col h-3/5 w-full justify-around bg-cover bg-top bg-no-repeat md:bg-right-top md:h-5/6 sm:bg-right-top xs:bg-right-top 2xs:bg-right-top" style="background-image: url('{{ asset('img/bg-index.jpg') }}')">
            <div id="content-welcome" class="max-w-4xl pl-20 flex flex-col justify-between gap-12 md:max-w-screen-md md:mx-auto md:px-0 md:gap-64 sm:px-0 sm:mx-auto sm:max-w-screen-sm">
                <img src="{{ asset('img/TipografíaLogotipo.png') }}">
                <button onclick="location.href='{{ route('how-to') }}'" class="self-center h-16 w-80 text-2xl shadow-solid-primary
                border-2 border-black py-2 px-4
                transition-colors ease-out
                duration-500 text-white
                bg-gradient-to-r
                mt-24 from-gray-900 to-black
                hover:from-white hover:to-gray-100
                hover:text-black hover:border-black
                 rounded-full md:mt-56">
                        EMPEZAR
                </button>
            </div>
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
        <style>
            :root {
                --color-primary: #7e22ce;
                --font-display: "Raleway", sans-serif;
            }
            body {
                font-family: var(--font-display);
            }
            .shadow-solid-primary {
                box-shadow: 10px 10px var(--color-primary);
            }
        </style>
        <footer id="footer-welcome" class="bg-transparent text-white py-6 md:h-32 md:items-center md:py-auto container flex justify-between mx-auto px-8 md:px-auto lg:px-32 md:flex md:self-center md:pt-10 md:flex-row md:py-auto 2xs:flex-col xs:flex-col sm:flex-col">
            <!-- Logo and Description -->
            <div class="mb-4 md:mb-0">
                <img src="{{ asset('img/TipografíaLogotipo.png') }}" alt="Logo" class="h-4 mb-2">
            </div>
            <!-- Copyright -->
            <div class="text-center text-gray-500 text-xs">
                &copy; 2024 Storyweaver. Todos los derechos reservados.
            </div>
        </footer>
    </body>
</html>
