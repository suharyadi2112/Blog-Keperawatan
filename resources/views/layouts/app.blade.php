<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RSUD Raja Ahmad Tabib</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/img/kepri.png">
		
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    @include('layouts.style')
    @stack('styles')
</head>
<body>
    @include('layouts.header')
            @yield('content')
    @include('layouts.footer')
    @include('layouts.script')
    @stack('scripts')
</body>
</html>
