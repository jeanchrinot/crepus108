
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark-bg">
<head>
    <script type="text/javascript">
        if(localStorage.getItem('user_token')){
            window.location = '/panel/dashboard';
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MAKIBOOM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('panel-assets/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome Css -->
    <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('panel-assets/css/app.css') }}" rel="stylesheet">
</head>
<body class="dark-bg">
    <div id="app">
        <div class="header" style="width: 100%;margin: 0;">
            <nav class="navbar navbar-light bg-light">
              <a href="/" target="_blank"><span class="navbar-brand mb-0 h1">{{ config('app.name', 'Makiboom') }}</span></a>
            </nav>
        </div>
        <div class="main-content" style="width: 100%;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card" style="margin-top: 2rem;margin-bottom: 2rem;">
                            <div class="card-header">
                                <h1 class="card-header__title">Login</h1>
                            </div>
                            <div class="card-body">
                                <login-form></login-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>