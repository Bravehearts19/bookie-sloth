<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/_custom.css')}}">

        <script src="{{asset('js/app.js')}}" defer></script>
        <script src="{{asset('js/vue.js')}}" defer></script>
    </head>
    <body>
        <div id="app">

        </div>

        <form action="/api/search" method="POST">
            @csrf

            <input type="text" name="name" id="name">

            <button class="btn btn-primary" type="submit">Cliccami</button>
        </form>

        <h1 class="text-success">Nuova pagina</h1>
    <body>
</html>
