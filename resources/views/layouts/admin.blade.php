<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ getSystemAcronym() }}</title>

    <!-- Fonts -->
    <link href="{{ asset('admin/vendor/fontawesome-free-6.2.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin//vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="{{ asset('admin/vendor/toast/toastr.min.css') }}" rel="stylesheet">

    <link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('admin/img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/img/favicon-16x16.png') }}">
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

        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('admin/js/custom.js') }}"></script>
        <script src="{{ asset('admin/vendor/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
        {{-- calendar --}}
        <script src="{{ asset('admin/vendor/moment/moment.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/fullcalendar/fullcalendar.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        {{-- charts --}}
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('admin/vendor/ckeditor5/ckeditor.js') }}"></script>
        <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>


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
