<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Thai Authentic' }}</title>
        
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @livewireScripts
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @if(request()->routeIs('reserve'))
      @vite(['resources/sass/reserve.scss', 'resources/js/reserve.js'])
    @endif
    </head>
    <body class="main">
        
        {{ $slot }}
    </body>
</html>
