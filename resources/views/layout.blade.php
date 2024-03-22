<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Шар предсказаний</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/scripts.js'])
    </head>
    <body class="antialiased">
            <main>
                <div class="container">
                    @yield ('content')
                </div>
            </main>
    </body>
</html>
