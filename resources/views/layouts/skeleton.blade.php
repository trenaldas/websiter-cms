<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('img/tiny.png') }}"/>
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}"/>
    @livewireStyles
</head>
<body>

@yield('app')

@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/init-alpine.js') }}"></script>
@stack('scripts')
</body>
</html>
