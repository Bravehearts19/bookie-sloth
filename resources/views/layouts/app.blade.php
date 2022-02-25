<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('js/vue.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- TomTom -->
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>

    @php
        Auth::check();
        $signedIn = false;
        if(Auth::check()) {
            $signedIn = 1;
        } else {
            $signedIn = 0;
        }
    @endphp

    <script>
        let user = {{$signedIn}};
        window.App = user;
    </script> {{-- Testing per l'autenticazione in Vue --}}
</head>
<body>
    <div class="bg-primary full-height d-flex flex-column">

        {{-- <header class="py-3 border-none d-flex justify-content-center align-items-center">
            <img src="/images/logo.svg" alt="slothel logo">
            <h1>Slothel</h1>
        </header> --}}
        <main class="flex-grow-1 radius-top bg-pattern shadow-lg">
            @yield('content')
        </main>

    </div>
</body>
</html>
