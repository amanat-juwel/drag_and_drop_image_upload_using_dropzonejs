<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/custom-login.css') }}">
</head>
<style type="text/css">
    body#LoginForm{ 
        background-image:url("{{asset('public/image/login-bg.jpg')}}"); 
        background-repeat:no-repeat; 
        background-position:center; 
        background-size:cover; 
        padding:10px;
    }
</style>
<body id="LoginForm">
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}"></script>

</body>
</html>
