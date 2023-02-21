<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') | {{ getSystemAcronym() }}</title>

    <!-- Fonts -->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin//vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar-5.11.3.css') }}">
    <link href="{{ asset('admin/vendor/toast/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.icon8.com/fonts/icon8.css">

    <!-- select2 -->
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <!-- select2-bootstrap4-theme -->
    <link href="{{ asset('admin/vendor/select2/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">

    {{-- <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('admin/img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/img/favicon-16x16.png') }}"> --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/img/' . getFavicon()) }}">
    @livewireStyles
</head>

<body id="page-top">

    <div id="wrapper">

        @include('layouts.inc.user.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                @include('layouts.inc.user.navbar')

                <div class="container-fluid">

                    @yield('content')

                </div>

            </div>
            @include('layouts.inc.user.footer')
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

        <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
        <script src="{{ asset('admin/js/custom.js') }}"></script>
        <script src="{{ asset('admin/js/validate.js') }}"></script>

        <script src="{{ asset('admin/vendor/moment/moment.min.js') }}"></script>
        <!-- select2 -->
        <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

        <script src="{{ asset('admin/vendor/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/toast/toastr.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/isotope/isotope.pkgd.js') }}"></script>
        <script src="{{ asset('admin/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
        <script src="{{ asset('assets/js/fullcalendar-5.11.3.js') }}"></script>
        <script src="https://cdn.icon8.com/js/icon8.js"></script>

        <script>
            $(document).ready(function() {
                if ($(window).width() < 768) {
                    $(".sidebar").addClass("toggled");
                    $(".nav-link").addClass("collapsed");
                    $("#collapseUtilities").removeClass("show");
                }
                toastr.options.timeOut = 40000;
                @if (Session::has('success'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.success("{{ session('success') }}");
                @endif

                @if (Session::has('error'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("{{ session('error') }}");
                @endif

                @if (Session::has('info'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.info("{{ session('info') }}");
                @endif

                @if (Session::has('warning'))
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.warning("{{ session('warning') }}");
                @endif
            });
        </script>
        @livewireStyles

        @yield('scripts')
</body>

</html>
