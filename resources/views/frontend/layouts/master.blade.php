<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @include('frontend.partials.header')
    @yield('css')
</head>

<body>

    <!--=============================
        TOPBAR START
    ==============================-->
    @include('frontend.layouts.topbar')
    <!--=============================
        TOPBAR END
    ==============================-->

    <!--=============================
        MENU START
    ==============================-->
    @include('frontend.layouts.menu')
    <!--=============================
        MENU END
    ==============================-->

    @yield('content')

    <!--=============================
        FOOTER START
    ==============================-->
    @include('frontend.layouts.footer')
    <!--=============================
        FOOTER END
    ==============================-->

    <!--=============================
        SCROLL BUTTON START
    ==============================-->
    @include('frontend.components.scroll-button')
    <!--=============================
        SCROLL BUTTON END
    ==============================-->

    <!--jquery library js-->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <!--font-awesome js-->
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
    <!-- slick slider -->
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <!-- isotop js -->
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <!-- simplyCountdownjs -->
    <script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
    <!-- counter up js -->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
    <!-- nice select js -->
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <!-- venobox js -->
    <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
    <!-- sticky sidebar js -->
    <script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
    <!-- wow js -->
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <!-- ex zoom js -->
    <script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>

    <!--toastr js-->
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
    <!--main/custom js-->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--show message dynamic vaidation js-->
    <script>

        toastr.options.progressBar = true;

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
        // Set csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
