<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{ getSystemName() }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') | {{ getSystemAcronym() }}</title>

    <!-- Fonts -->
    <link href="{{ asset('admin/vendor/fontawesome-free-6.2.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/toast/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/jqueryui/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/keithwood/jquery.signature.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/dropzone/dropzone.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/bootstrap-toggle/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/fullcalendar-5.11.3.css') }}" rel="stylesheet">
    <!-- select2 -->
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/select2/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/tempusdominus/tempusdominus-bootstrap-4.css') }}" rel="stylesheet">

    {{-- <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('admin/img/apple-touch-icon.png') }}"> --}}
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/img/favicon-32x32.png') }}"> --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/img/' . getFavicon()) }}">
    @livewireStyles
</head>

<body id="page-top">

    <div id="wrapper">

        @include('layouts.inc.admin.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                @include('layouts.inc.admin.navbar')

                <div class="container-fluid">

                    @yield('content')

                </div>

            </div>
            @include('layouts.inc.admin.footer')
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/jqueryui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('admin/js/custom.js') }}"></script>
        <script src="{{ asset('admin/vendor/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
        {{-- calendar --}}
        <script src="{{ asset('admin/vendor/moment/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/fullcalendar-5.11.3.js') }}"></script>
        <script src="{{ asset('admin/vendor/toast/toastr.min.js') }}"></script>

        {{-- charts --}}
        <script src="{{ asset('admin/vendor/highchart/highcharts.js') }}"></script>
        <script src="{{ asset('admin/vendor/highchart/data.js') }}"></script>
        <script src="{{ asset('admin/vendor/highchart/drilldown.js') }}"></script>
        <script src="{{ asset('admin/vendor/highchart/exporting.js') }}"></script>
        <script src="{{ asset('admin/vendor/highchart/export-data.js') }}"></script>
        <script src="{{ asset('admin/vendor/highchart/accessibility.js') }}"></script>

        <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/ckeditor5/ckeditor.js') }}"></script>
        <script src="{{ asset('admin/vendor/keithwood/jquery.signature.js') }}"></script>
        <script src="{{ asset('admin/vendor/dropzone/dropzone.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/tempusdominus/tempusdominus-bootstrap-4.min.js') }}"></script>


        <script>
            $(document).ready(function() {
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
