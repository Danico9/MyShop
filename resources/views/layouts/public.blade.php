<!DOCTYPE html>
<html lang="es">
<head>
    {{-- Asegúrate de que partials.head existe, si no, usa el bloque <head> estándar --}}
        @include('partials.head')
    </head>
<body class="bg-gray-50">

@include('partials.header')

@include('partials.flash-messages')

<main class="min-h-screen">
    @yield('content')
</main>

@include('partials.footer')

@stack('scripts')
</body>
</html>
