<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/boostrap5.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
</head>
<body>

    <div>
        @include('layouts.navbar')
        @yield('content')
    </div>
    <script scr="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <script scr="{{asset('frontend/js/bootstrap.bundle.js')}}"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</body>
</html>
