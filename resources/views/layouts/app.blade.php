<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>{{ env('APP_NAME', 'Laravel') }} | @yield('page-name')</title>

    <!-- Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <header>
        @include('layouts.partials._navbar')
    </header>
    <main class="pt-4">
        @yield('content')
    </main>
</body>

</html>
