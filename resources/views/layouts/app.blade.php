<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="assets/img/favicon.png">
		
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    @include('layouts.style')
    @stack('styles')
</head>
<body>
    <div class="preloader">
        <div class="loader">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>

            <div class="indicator"> 
                <svg width="16px" height="12px">
                    <polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                    <polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
                </svg>
            </div>
        </div>
    </div>

    <!-- Mediplus Color Plate -->
		<div class="color-plate">
			<a class="color-plate-icon"><i class="fa fa-cog fa-spin"></i></a>
			<h4>Mediplus</h4>
			<p>Here is some awesome color's available on Mediplus Template.</p>
			<span class="color1"></span>
			<span class="color2"></span>
			<span class="color3"></span>
			<span class="color4"></span>
			<span class="color5"></span>
			<span class="color6"></span>
			<span class="color7"></span>
			<span class="color8"></span>
			<span class="color9"></span>
			<span class="color10"></span>
			<span class="color11"></span>
			<span class="color12"></span>
		</div>
		<!-- /End Color Plate -->

    @include('layouts.header')
            @yield('content')
    @include('layouts.footer')
    @include('layouts.script')
    @stack('scripts')
</body>
</html>
