<html class="bg-gray-100" lang="en">
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
    <head>
        @include('layouts.header')
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

            @include("layouts.footer-landing")
        </div>

        @include("layouts.footer")
    </body>
</html>
