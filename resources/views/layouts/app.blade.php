<html class="bg-gray-100" lang="en">
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
{{--        <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
{{--        <script src="{{ mix('js/app.js') }}" defer></script>--}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('head')

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
{{--            @include('layouts.navigation')--}}
            @include("layouts.navigation")

{{--            <!-- Page Heading -->--}}
{{--            <header class="bg-white shadow">--}}
{{--                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                    {{ $header }}--}}
{{--                </div>--}}
{{--            </header>--}}

            <!-- Page Content -->
            <main id="#app">
                {{ $slot }}
            </main>

            @include("layouts.footer")
        </div>

        <script src="https://kit.fontawesome.com/112da9a3ba.js" crossorigin="anonymous"></script>
        @stack('scripts')
    </body>
</html>
