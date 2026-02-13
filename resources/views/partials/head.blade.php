<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'TechValencia')</title>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: {
                        500: '#3b82f6',
                        600: '#2563eb',
                        700: '#1d4ed8',
                    }
                }
            }
        }
    }
</script>

@stack('styles')
