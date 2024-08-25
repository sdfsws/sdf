<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css'])
    @vite('resources/js/app.js')
    @vite('resources/sass/app.scss')
    @stack('styles') <!-- Ensure this line is included -->
</head>
<body>
    <div id="app">
        <x-nav-menu />

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success mt-3">
                <strong>Success:</strong> {{ session('success') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-info mt-3">
                {{ session('status') }}
            </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
