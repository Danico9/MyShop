<!-- Carrito de Compras -->
<header x-data="{ open: false }" class="bg-white shadow-lg relative">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            
            <div class="flex items-center">
                <!-- Botón Hamburguesa (Móvil) - A la izquierda -->
                <div class="-ms-2 mr-2 flex items-center md:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <a href="{{ route('welcome') }}" class="text-2xl font-bold text-primary-600">
                    🛍️ TechValencia
                </a>
            </div>

            <!-- Navegación Escritorio -->
            @include('partials.navigation')

            <!-- Carrito y Usuario -->
            @php
            $cart = session('cart', []);
            $totalQuantity = array_sum(array_column($cart, 'quantity'));
            @endphp
            <div class="flex items-center space-x-4 md:space-x-6">
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-primary-600 transition flex items-center">
                    <span class="text-xl mr-1">🛒</span>
                    <span class="hidden sm:inline font-medium">Carrito ({{ $totalQuantity }})</span>
                    <span class="sm:hidden font-medium">({{ $totalQuantity }})</span>
                </a>

                <!-- Usuario (Visible en escritorio) -->
                <div class="hidden md:flex items-center space-x-4 border-l pl-6 border-gray-200">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-600 font-medium flex items-center">
                            <span class="mr-2">👤</span> {{ Auth::user()->name }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-primary-600 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="text-sm bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition font-bold">Registro</a>
                    @endauth
                </div>

                <!-- Icono de Usuario (Visible SOLO en móvil) -->
                <div class="flex md:hidden items-center border-l pl-4 border-gray-200">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-primary-600 text-xl" title="Ir al Dashboard">
                            👤
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 text-xl" title="Iniciar Sesión">
                            🔑
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Menú Desplegable Móvil -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                Inicio
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                Productos
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                Categorías
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('offers.index')" :active="request()->routeIs('offers.*')">
                Ofertas
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                Contacto
            </x-responsive-nav-link>

            @auth
                <div class="border-t border-gray-200 my-2"></div>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard ({{ Auth::user()->name }})
                </x-responsive-nav-link>
            @else
                <div class="border-t border-gray-200 my-2"></div>
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    Iniciar Sesión
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    Registrarse
                </x-responsive-nav-link>
            @endauth
        </div>
    </div>
</header>
