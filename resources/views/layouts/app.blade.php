<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="emerald">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')
        <a href="#" class="hidden" id="close-modal"></a>
        <!-- Page Heading -->
        @if (isset($header))
            {{-- <header class="bg-white shadow"> --}}
            {{-- <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8"> --}}
            {{-- {{ $header }} --}}
            {{-- </div> --}}
            {{-- </header> --}}
        @endif

        <!-- Page Content -->
        <main class="min-w-0 w-full flex-auto lg:static lg:max-h-full lg:overflow-visible">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

<script>
    document.addEventListener('keyup', (e) => {
        if (e.key === "Escape") {
            document.getElementById("close-modal").click();
        }
    });
</script>

</html>
