<nav class="hidden md:flex space-x-8">
    {{-- Enlace Inicio --}}
    <a href="{{ route('welcome') }}"
       class="text-gray-700 hover:text-primary-600 transition {{ request()->routeIs('welcome') ? 'font-bold text-primary-600' : '' }}">
        Inicio
    </a>

    {{-- Enlace Productos --}}
    <a href="{{ route('products.index') }}"
       class="text-gray-700 hover:text-primary-600 transition {{ request()->routeIs('products.*') ? 'font-bold text-primary-600' : '' }}">
        Productos
    </a>

    {{-- Enlace Categorías --}}
    <a href="{{ route('categories.index') }}"
       class="text-gray-700 hover:text-primary-600 transition {{ request()->routeIs('categories.*') ? 'font-bold text-primary-600' : '' }}">
        Categorías
    </a>

    {{-- Enlace Ofertas --}}
    <a href="{{ route('offers.index') }}"
       class="text-gray-700 hover:text-primary-600 transition {{ request()->routeIs('offers.*') ? 'font-bold text-primary-600' : '' }}">
        Ofertas
    </a>

    {{-- Enlace Contacto --}}
    <a href="{{ route('contact') }}"
       class="text-gray-700 hover:text-primary-600 transition {{ request()->routeIs('contact') ? 'font-bold text-primary-600' : '' }}">
        Contacto
    </a>

    {{-- Enlaces Condicionales de Autenticación --}}
    @auth
    {{-- Si el usuario ESTÁ logueado, ve el enlace al Dashboard --}}
    <a href="{{ route('dashboard') }}"
       class="text-gray-700 hover:text-primary-600 transition {{ request()->routeIs('dashboard') ? 'font-bold text-primary-600' : '' }}">
        Dashboard
    </a>
    @endauth

    @guest
    {{-- Si el usuario NO está logueado, ve el enlace de Login --}}
    <a href="{{ route('login') }}"
       class="text-gray-700 hover:text-primary-600 transition {{ request()->routeIs('login') ? 'font-bold text-primary-600' : '' }}">
        Login
    </a>
    @endguest
</nav>
