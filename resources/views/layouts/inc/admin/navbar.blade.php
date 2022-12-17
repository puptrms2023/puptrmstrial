<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 sticky-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <div class="mr-auto ml-md-3 my-2 my-md-0 mw-100">
        <div class="text-primary font-weight-bold">{{ getSystemName() }}</div>
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
                    <a href="{{ url('admin/preview') }}" class="float-right text-white">Mark all as read</a>
                </h6>
                @foreach (Auth::user()->unreadNotifications->take(4) as $notification)
                    @if ($notification->data['award'] == 'AE')
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ url('admin/academic-excellence-awardees/' . $notification->id) }}">
                        @elseif ($notification->data['award'] == 'AA')
                            <a class="dropdown-item d-flex align-items-center"
                                href="{{ url('admin/achiever-awardees/' . $notification->id) }}">
                            @elseif ($notification->data['award'] == 'DL')
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ url('admin/deans-listers/' . $notification->id) }}">
                                @elseif ($notification->data['award'] == 'PL')
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ url('admin/presidents-listers/' . $notification->id) }}">
                                    @else
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ url('admin/non-academic-awardees/' . $notification->id) }}">
                    @endif
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fa-solid fa-user text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">
                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</div>
                        <span class="font-weight-bold">
                            {{ $notification->data['user_name'] }}
                            submitted application for
                            @if ($notification->data['award'] == 'AA')
                                Achiever's Award
                            @elseif ($notification->data['award'] == 'DL')
                                Dean's List
                            @elseif ($notification->data['award'] == 'PL')
                                President's List
                            @elseif ($notification->data['award'] == 'AE')
                                Academic Excellence
                            @elseif ($notification->data['award'] == 'LA')
                                Leadership Award
                            @elseif ($notification->data['award'] == 'AYA')
                                Athlete of the Year Award
                            @elseif ($notification->data['award'] == 'OOA')
                                Outstanding Organization Award
                            @elseif ($notification->data['award'] == 'BTA')
                                Best Thesis Award
                            @elseif ($notification->data['award'] == 'GOP')
                                Graduating Organization Presidents
                            @elseif ($notification->data['award'] == 'GSA')
                                Graduating Student Assistants
                            @elseif ($notification->data['award'] == 'OC')
                                Outside Competitions
                            @elseif ($notification->data['award'] == 'GPDT')
                                Graduating member of PUPT Dance Troupe
                            @elseif ($notification->data['award'] == 'GPCG')
                                Graduating member of PUPT Choral Group (CHANTERS)
                            @endif
                        </span>
                    </div>
                    </a>
                @endforeach
                <a class="dropdown-item text-center small text-gray-500"
                    href="{{ url('admin/all-notifications') }}">View
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
                <a class="dropdown-item" href="{{ url('admin/profile') }}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="{{ url('admin/change-password') }}">
                    <i class="fa-solid fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Change Password
                </a>
                @can('menu activity log')
                    <a class="dropdown-item" href="{{ url('admin/user-activity-log') }}">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a>
                @endcan

                @can('settings view')
                    <a class="dropdown-item" href="{{ url('admin/manage-settings') }}">
                        <i class="fa-solid fa-gear fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                @endcan

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
