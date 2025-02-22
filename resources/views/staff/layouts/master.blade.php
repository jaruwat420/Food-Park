<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}?v{{ rand() }}">
    <title> @yield('title') </title>

    {{-- CSS --}}
    @include('staff.layouts.partials.css')
    {{-- CSS --}}
    @yield('css')
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');

    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            {{-- Sidebar --}}
            @include('staff.layouts.sidebar')
            {{-- Sidebar --}}

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- Main Content -->

            {{-- footer --}}
            @include('staff.layouts.footer')
        </div>
    </div>

    {{-- Javascripts --}}
    @include('staff.layouts.partials.javascripts')

</body>

</html>
