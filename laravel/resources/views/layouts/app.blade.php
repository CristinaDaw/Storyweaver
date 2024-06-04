<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/Isotipo-white.png') }}">

        <title>Storyweaver</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" type="text/css" src="/opt/lampp/htdocs/apiSW/resources/views/layouts/app.blade.php" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <script type="module" src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/mirage.js"></script>
        <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased min-h-screen overflow-auto flex flex-col">
        <div class="bg-gray-100 dark:bg-gray-900 flex-1 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
                <div class="h-[20%]">
                    <footer id="app-footer" class="w-full bg-gray-900 text-white m-0 py-6 md:items-center md:py-auto flex justify-between px-8 md:px-auto lg:px-32 md:flex md:self-center md:pt-10 md:flex-row md:py-auto sm:flex sm:flex-col 2xs:flex-col xs:flex-col">
                        <!-- Logo and Description -->
                        <div id="logo-footer" class="mb-4 md:mb-0">
                            <img src="{{ asset('img/TipografíaLogotipo.png') }}" alt="Logo" class="h-4 mb-2">
                        </div>
                        <!-- Copyright -->
                        <div id="footer-text" class="text-center text-gray-500 text-xs">
                            &copy; 2024 Storyweaver. Todos los derechos reservados.
                        </div>
                    </footer>
                </div>
            </main>
        </div>
        <script type="module" src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/mirage.js"></script>
    </body>
</html>
