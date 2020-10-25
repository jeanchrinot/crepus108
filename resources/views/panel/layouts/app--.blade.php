<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark-bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MAKIBOOM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('panel/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome Css -->
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('panel/css/app.css') }}" rel="stylesheet">
</head>
<body class="dark-bg">
    <div id="app">
        <div class="header" style="width: 100%;margin: 0;">
            <nav class="navbar navbar-light bg-light">
              <span class="navbar-brand mb-0 h1">{{ config('app.name', 'MAKIBOOM') }} Panel</span>
            </nav>
        </div>
        <div class="main-content" style="width: 100%;">
            @yield('main')
        </div>
    </div>
</body>
</html>