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
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
