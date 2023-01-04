<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Verify Award | {{ getSystemAcronym() }}</title>

    <!-- Fonts -->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin//vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/img/' . getFavicon()) }}">
    @livewireStyles
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('admin/img/puplogomini.png') }}"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PUPT RMS</div>
            </a>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 sticky-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <div class="mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        <div class="text-primary font-weight-bold">PUP Taguig Recognition Management System</div>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if (Auth::check())
                            <a href="{{ route('home') }}" class="mr-auto ml-md-3 my-2 my-md-0 mw-100">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="mr-auto ml-md-3 my-2 my-md-0 mw-100">Login</a>
                        @endif
                    </ul>

                </nav>
                <div class="container-fluid">

                    <div class="container">
                        @if (empty($user_sa) && empty($user_ae) && empty($user_na))
                            No Record Found
                        @else
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <h1 class="text-uppercase text-primary mt-5">VERIFIED</h1>
                                    <div class="done mt-4">
                                        <svg version="1.1" id="tick" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 37 37" style="enable-background:new 0 0 37 37;"
                                            xml:space="preserve">
                                            <path class="circ path"
                                                style="fill:#f1c40f;stroke:#A14A49;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;"
                                                d="
                        M30.5,6.5L30.5,6.5c6.6,6.6,6.6,17.4,0,24l0,0c-6.6,6.6-17.4,6.6-24,0l0,0c-6.6-6.6-6.6-17.4,0-24l0,0C13.1-0.2,23.9-0.2,30.5,6.5z" />
                                            <polyline class="tick path"
                                                style="fill:none;stroke:#fff;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;"
                                                points="
                        11.6,20 15.9,24.2 26.4,13.8 " />
                                        </svg>
                                    </div>
                                    <div class="mt-4">
                                        @if (!empty($user_sa))
                                            <p>
                                                Name:
                                                <b>{{ $user_sa->users->first_name . ' ' . $user_sa->users->last_name }}</b><br>
                                                Award Received: <b>{{ $user_sa->award->name }}</b><br>
                                                Polytechnic University of the Philippines - Taguig<br>
                                                School Year: <b>{{ $user_sa->school_year }}</b>
                                            </p>
                                        @elseif (!empty($user_ae))
                                            <p>
                                                Name:
                                                <b>{{ $user_ae->users->first_name . ' ' . $user_ae->users->last_name }}</b><br>
                                                Award Received: <b>{{ $user_ae->award->name }}</b><br>
                                                Polytechnic University of the Philippines - Taguig<br>
                                                School Year: <b>{{ $user_ae->school_year }}</b>
                                            </p>
                                        @elseif (!empty($user_na))
                                            <p>
                                                Name:
                                                <b>{{ $user_na->users->first_name . ' ' . $user_na->users->last_name }}</b><br>
                                                Award Received: <b>{{ $user_na->nonacad->name }}</b><br>
                                                Polytechnic University of the Philippines - Taguig<br>
                                                School Year: <b>{{ $user_na->school_year }}</b>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ getSystemAcronym() }}</span>
                    </div>
                </div>
            </footer>

        </div>

        <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
        <script>
            $(window).on("load", function() {
                setTimeout(function() {
                    $('.done').addClass("drawn");
                }, 500);

            });
        </script>
</body>

</html>
