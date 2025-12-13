
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('templatemo-noir-fashion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="font-sans text-gray-900 antialiased auth-body">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/" wire:navigate class="logo-link">
                <svg class="logo-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
                    <defs>
                        <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#fff;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#ff3366;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <polygon points="50,10 20,50 50,90 80,50" fill="none" stroke="url(#logoGrad)" stroke-width="3"/>
                    <circle cx="50" cy="50" r="5" fill="url(#logoGrad)"/>
                </svg>
                <span class="logo-text">Mayari</span>
            </a>
        </div>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
