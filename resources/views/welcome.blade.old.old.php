<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            500: '#6997ca',
                            600: '#4b7db2',
                            700: '#316298',
                        },
                        secondary: {
                            500: '#63d1c1',
                            600: '#41b8a5',
                        }
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Header con navegación -->
    <header class="bg-white dark:bg-gray-800 shadow-lg relative">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-2xl font-bold text-primary-600 hover:text-primary-700 transition">🛍️ Mi Tienda Daniel Ciscar Blazquez</a>
                </div>

                <!-- Navegación desktop -->
                <nav class="hidden lg:flex space-x-8">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Inicio</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Productos</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Categorías</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Ofertas</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Contacto</a>
                </nav>

                 <!-- Botones desktop -->
                 <div class="hidden lg:flex items-center space-x-4">
                     <button class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">
                         🛒 Carrito (0)
                     </button>
                     <button class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                         Iniciar Sesión
                     </button>
                     <button class="border-2 border-primary-600 text-primary-600 px-4 py-2 rounded-lg hover:bg-primary-600 hover:text-white transition">
                         Registrarse
                     </button>
                     <!-- Botón de modo oscuro desktop -->
                     <button id="darkModeToggleDesktop" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition p-2 rounded-full">
                         🌙
                     </button>
                 </div>

                <!-- Botones móvil/tablet -->
                <div class="flex items-center space-x-2 lg:hidden">
                    <!-- Botón de modo oscuro -->
                    <button id="darkModeToggle" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition p-2 rounded-full dark-mode-toggle">
                        🌙
                    </button>
                    <!-- Botón menú móvil -->
                    <button id="mobileMenuToggle" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

                <!-- Menú móvil -->
                <div id="mobileMenu" class="lg:hidden hidden mt-4 pb-4 border-t border-gray-200 dark:border-gray-700 mobile-menu">
                <nav class="flex flex-col space-y-4 pt-4">
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Inicio</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Productos</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Categorías</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Ofertas</a>
                    <a href="#" class="text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">Contacto</a>
                    <div class="flex flex-col space-y-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <button class="text-left text-gray-700 dark:text-gray-300 hover:text-primary-600 transition">
                            🛒 Carrito (0)
                        </button>
                        <button class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition text-left">
                            Iniciar Sesión
                        </button>
                        <button class="border-2 border-primary-600 text-primary-600 px-4 py-2 rounded-lg hover:bg-primary-600 hover:text-white transition text-left">
                            Registrarse
                        </button>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-gradient text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                Bienvenido a Mi Tienda
            </h2>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Descubre una amplia variedad de productos de calidad.
                Encuentra lo que buscas al mejor precio.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <button class="bg-white text-primary-600 font-bold py-4 px-8 rounded-full hover:bg-gray-100 transition duration-300 ease-in-out transform hover:scale-105">
                    Ver Productos
                </button>
                <button class="border-2 border-white text-white font-bold py-4 px-8 rounded-full hover:bg-white hover:text-primary-600 transition duration-300 ease-in-out">
                    Ofertas Especiales
                </button>
            </div>
        </div>
    </section>

    <!-- Categorías de Productos -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h3 class="text-3xl font-bold mb-12 text-center text-gray-900 dark:text-white">
                Nuestras Categorías
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 product-card cursor-pointer">
                    <div class="text-4xl text-primary-500 mb-4">📦</div>
                    <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Categoría 1</h4>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Descripción de la primera categoría de productos.
                    </p>
                    <button class="text-primary-600 font-semibold hover:text-primary-700 transition">
                        Ver Productos →
                    </button>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 product-card cursor-pointer">
                    <div class="text-4xl text-primary-500 mb-4">🛍️</div>
                    <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Categoría 2</h4>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Descripción de la segunda categoría de productos.
                    </p>
                    <button class="text-primary-600 font-semibold hover:text-primary-700 transition">
                        Ver Productos →
                    </button>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 product-card cursor-pointer">
                    <div class="text-4xl text-primary-500 mb-4">⭐</div>
                    <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Categoría 3</h4>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Descripción de la tercera categoría de productos.
                    </p>
                    <button class="text-primary-600 font-semibold hover:text-primary-700 transition">
                        Ver Productos →
                    </button>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 product-card cursor-pointer">
                    <div class="text-4xl text-primary-500 mb-4">🎯</div>
                    <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Categoría 4</h4>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Descripción de la cuarta categoría de productos.
                    </p>
                    <button class="text-primary-600 font-semibold hover:text-primary-700 transition">
                        Ver Productos →
                    </button>
                </div>

            </div>
        </div>
    </section>

    <!-- Productos Destacados -->
    <section class="py-16 bg-gray-100 dark:bg-gray-800">
        <div class="container mx-auto px-6">
            <h3 class="text-3xl font-bold mb-12 text-center text-gray-900 dark:text-white">
                Productos Destacados
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden product-card">
                    <div class="h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <span class="text-4xl">📦</span>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Producto 1</h4>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">Descripción del primer producto</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-primary-600">€XX</span>
                            <button class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                                Añadir al Carrito
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden product-card">
                    <div class="h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <span class="text-4xl">🛍️</span>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Producto 2</h4>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">Descripción del segundo producto</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-primary-600">€XX</span>
                            <button class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                                Añadir al Carrito
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden product-card">
                    <div class="h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <span class="text-4xl">⭐</span>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Producto 3</h4>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">Descripción del tercer producto</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-primary-600">€XX</span>
                            <button class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                                Añadir al Carrito
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h5 class="text-xl font-bold mb-4">🛍️ Mi Tienda</h5>
                    <p class="text-gray-400">
                        Tu tienda de confianza para encontrar los mejores productos.
                    </p>
                </div>
                <div>
                    <h6 class="font-bold mb-4">Enlaces Rápidos</h6>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Sobre Nosotros</a></li>
                        <li><a href="#" class="hover:text-white transition">Política de Privacidad</a></li>
                        <li><a href="#" class="hover:text-white transition">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-white transition">Envíos y Devoluciones</a></li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-bold mb-4">Atención al Cliente</h6>
                    <ul class="space-y-2 text-gray-400">
                        <li>📞 Teléfono de contacto</li>
                        <li>📧 Email de contacto</li>
                        <li>💬 Chat en vivo</li>
                        <li>🕒 Horario de atención</li>
                    </ul>
                </div>
                <div>
                    <h6 class="font-bold mb-4">Síguenos</h6>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">📘 Facebook</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">📷 Instagram</a>
                        <a href="#" class="text-gray-400 hover:text-white transition">🐦 Twitter</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Mi Tienda. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

     <script>
         // Toggle dark mode functionality
         function toggleDarkMode() {
             document.documentElement.classList.toggle('dark');
             localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));

             // Cambiar el icono según el modo para ambos botones
             const toggleButton = document.getElementById('darkModeToggle');
             const toggleButtonDesktop = document.getElementById('darkModeToggleDesktop');

             if (document.documentElement.classList.contains('dark')) {
                 if (toggleButton) toggleButton.innerHTML = '☀️';
                 if (toggleButtonDesktop) toggleButtonDesktop.innerHTML = '☀️';
             } else {
                 if (toggleButton) toggleButton.innerHTML = '🌙';
                 if (toggleButtonDesktop) toggleButtonDesktop.innerHTML = '🌙';
             }
         }

        // Toggle mobile menu functionality
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuToggle = document.getElementById('mobileMenuToggle');

            mobileMenu.classList.toggle('hidden');

            // Cambiar el icono del botón
            if (mobileMenu.classList.contains('hidden')) {
                menuToggle.innerHTML = `
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                `;
            } else {
                menuToggle.innerHTML = `
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                `;
            }
        }

         // Check for saved dark mode preference
         document.addEventListener('DOMContentLoaded', function() {
             if (localStorage.getItem('darkMode') === 'true') {
                 document.documentElement.classList.add('dark');
                 const toggleButton = document.getElementById('darkModeToggle');
                 const toggleButtonDesktop = document.getElementById('darkModeToggleDesktop');
                 if (toggleButton) toggleButton.innerHTML = '☀️';
                 if (toggleButtonDesktop) toggleButtonDesktop.innerHTML = '☀️';
             }

             // Configurar los botones
             const toggleButton = document.getElementById('darkModeToggle');
             const toggleButtonDesktop = document.getElementById('darkModeToggleDesktop');
             if (toggleButton) toggleButton.onclick = toggleDarkMode;
             if (toggleButtonDesktop) toggleButtonDesktop.onclick = toggleDarkMode;
             document.getElementById('mobileMenuToggle').onclick = toggleMobileMenu;
         });
    </script>
</body>
</html>
