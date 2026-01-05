<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.head')
</head>
<body class="bg-gray-50">
@include('partials.header')

<main class="min-h-screen">
    @yield('content')
</main>

@include('partials.footer')

@stack('scripts')
</body>
</html>
