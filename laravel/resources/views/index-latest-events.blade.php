<div id="default-carousel" class="mt-0" data-carousel="slide">
    <h2 class="text-xs font-semibold dark:text-white ml-24 mb-4">Eventos recientes</h2>
    <div class="flex items-center justify-center h-10 overflow-hidden rounded-lg mb-2 px-4 mx-24 bg-purple-100 dark:bg-purple-500 dark:text-white dark:border-none p-2 shadow-lg border border-solid border-purple-300">
        @foreach ($latestEvents as $key=>$event)
            <div class=" {{ $key == 0 ? 'active' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                <p class="text-xs m-2 text-center">{{ $event->description }}</p>
            </div>
        @endforeach
    </div>
</div>

<script>
    const carouselItems = document.querySelectorAll('[data-carousel-item]');
    let currentIndex = 0;

    // Función para mostrar el siguiente elemento del carrusel
    function showNextItem() {
        fadeOut(carouselItems[currentIndex], () => {
            carouselItems[currentIndex].classList.add('hidden');
            carouselItems[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % carouselItems.length;

                fadeIn(carouselItems[currentIndex]);
        });
    }

    // Función para desvanecer gradualmente un elemento
    function fadeOut(element, callback) {
        let opacity = 1;
        const interval = setInterval(() => {
            opacity -= 0.05; // Ajusta la velocidad de transición aquí
            element.style.opacity = opacity;
            if (opacity <= 0) {
                clearInterval(interval);
                if (callback) callback();
            }
        }, 150); // Ajusta el intervalo de tiempo aquí
    }

    // Función para hacer aparecer gradualmente un elemento
    function fadeIn(element, callback) {
        let opacity = 0;
        element.style.opacity = 0;
        element.classList.remove('hidden');
        element.classList.add('active');
        const interval = setInterval(() => {
            opacity += 0.05; // Ajusta la velocidad de transición aquí
            element.style.opacity = opacity;
            if (opacity >= 1) {
                clearInterval(interval);
                if (callback) callback();
            }
        }, 50); // Ajusta el intervalo de tiempo aquí
    }

    // Función para cambiar automáticamente el carrusel cada 5 segundos
    function autoChangeCarousel() {
        setInterval(() => {
            showNextItem();
        }, 5000); // Cambia cada 5 segundos (5000 milisegundos)
    }

    // Llama a la función para cambiar automáticamente el carrusel
    autoChangeCarousel();
</script>
