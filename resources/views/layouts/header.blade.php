<x-meta.tracking.ga4 />

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

<!-- Scripts -->
<script src="https://kit.fontawesome.com/112da9a3ba.js" crossorigin="anonymous"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])

@stack('head')