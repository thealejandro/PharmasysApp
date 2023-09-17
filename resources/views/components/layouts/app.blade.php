<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="emerald">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PharmasysApp Alpha') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="min-h-screen font-sans antialiased bg-gray-100">

    <x-jet-banner />

    <header>
        @livewire('navigation-menu')
    </header>

    <div class="py-4">

        <!-- Page Heading -->
        @if (isset($header))
        <header>
            <div class="w-full lg:max-w-[90%] px-4 mx-auto lg:px-8 sm:px-6">
                {{-- <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                </div> --}}

                <h1
                    class="text-opacity-100 text-[rgb(17,24,39)] tracking-tight text-center leading-tight font-bold text-3xl">
                    {{ $header }}
                </h1>
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main class="w-full">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>