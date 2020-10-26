<!doctype html>
<html lang="en">

<head>
    <script type="text/javascript">
        if(!localStorage.getItem('user_token')){
            window.location = '/panel/login';
        }
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Panel | Crépus 108</title>
    <script src="{{ asset('panel-assets/js/app.js') }}" defer></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" type="text/css" href="/css/fontawesome/css/font-awesome.min.css">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="/panel-assets/assets/styles/main.css" rel="stylesheet">
    <link href="{{ asset('panel-assets/css/app.css') }}" rel="stylesheet">
</head>
<body>
    @yield('app-container')

<script type="text/javascript" src="/panel-assets/assets/scripts/main.js"></script>
</body>
</html>