<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> @yield('title') </title>

    {{-- CSS --}}
    @include('admin.layouts.partials.css')
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
            @include('admin.layouts.sidebar')
            {{-- Sidebar --}}

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <!-- Main Content -->

            {{-- footer --}}
            @include('admin.layouts.footer')
        </div>
    </div>

    {{-- Javascripts --}}
    @include('admin.layouts.partials.javascripts')

</body>

</html>
