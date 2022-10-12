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
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if (Auth::user()->unreadNotifications->count() > 0)
                    <span
                        class="badge badge-danger badge-counter">{{ Auth::user()->unreadNotifications->count() }}</span>
                @endif
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notifications({{ Auth::user()->unreadNotifications->count() }})
                    <a href="{{ url('user/preview') }}" class="float-right text-white">Mark all as read</a>
                </h6>
                @foreach (Auth::user()->unreadNotifications as $notification)
                    @if ($notification->data['award'] == '4')
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ url('user/preview/academic-excellence/' . $notification->data['form_id']) }}">
                        @else
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ url('user/preview/academic-award/' . $notification->data['form_id']) }}">
                    @endif

                    <div class="mr-3">
                        @if ($notification->data['status'] == '1')
                            <div class="icon-circle bg-success">
                                <i class="fa-solid fa-circle-check text-white"></i>
                            </div>
                        @elseif ($notification->data['status'] == '2')
                            <div class="icon-circle bg-danger">
                                <i class="fa-solid fa-circle-xmark text-white"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="small text-gray-500">
                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                        </div>
                        <span class="font-weight-bold">
                            Your Application for
                            @if ($notification->data['award'] == '1')
                                Achiever's Award
                            @elseif ($notification->data['award'] == '2')
                                Dean's List
                            @elseif ($notification->data['award'] == '3')
                                President's List
                            @elseif ($notification->data['award'] == '4')
                                Academic Excellence
                            @endif
                            has been
                            @if ($notification->data['status'] == '1')
                                Approved
                            @elseif ($notification->data['status'] == '2')
                                Rejected
                            @endif
                        </span>
                    </div>
                    </a>
                @endforeach
                <a class="dropdown-item text-center small text-gray-500" href="{{ url('user/all-notifications') }}">View
                    All</a>
            </div>
        </li>
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username }}</span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ url('user/profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="{{ url('user/change-password') }}">
                    <i class="fa-solid fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
