<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_home_page">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin/img/puplogomini.png') }}"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PUPT RMS</div>
    </a>

    <hr class="sidebar-divider my-0">

    <div class="sidebar-heading mt-4 text-light">
        NAVIGATION PANE
    </div>

    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link align-middle" href="{{ url('admin/dashboard') }}">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span>Home</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/students') || Request::is('admin/students/*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('admin/students') }}">
            <i class="fa fa-id-card"></i>
            <span>Students</span>
        </a>
    </li>
    <li
        class="nav-item {{ Request::is('admin/achievers-award') || Request::is('admin/achievers-award/*') || Request::is('admin/deans-list-award') || Request::is('admin/deans-list-award/*') || Request::is('admin/presidents-list-award') || Request::is('admin/presidents-list-award/*') ? 'active' : '' }}">
        <a class="nav-link {{ Request::is('admin/achievers-award') || Request::is('admin/achievers-award/*') || Request::is('admin/deans-list-award') || Request::is('admin/deans-list-award/*') || Request::is('admin/presidents-list-award') || Request::is('admin/presidents-list-award/*') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-award"></i>
            <span>Academic Awards</span>
        </a>
        <div id="collapseTwo"
            class="collapse {{ Request::is('admin/achievers-award') || Request::is('admin/achievers-award/*') || Request::is('admin/deans-list-award') || Request::is('admin/deans-list-award/*') || Request::is('admin/presidents-list-award') || Request::is('admin/presidents-list-award/*') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/achievers-award') || Request::is('admin/achievers-award/*') ? 'active' : '' }}"
                    href="{{ url('admin/achievers-award') }}">Achiever's Award</a>
                <a class="collapse-item {{ Request::is('admin/deans-list-award') || Request::is('admin/deans-list-award/*') ? 'active' : '' }}"
                    href="{{ url('admin/deans-list-award') }}">Dean's List</a>
                <a class="collapse-item {{ Request::is('admin/presidents-list-award') || Request::is('admin/presidents-list-award/*') ? 'active' : '' }}"
                    href="{{ url('admin/presidents-list-award') }}">President's List</a>
                <a class="collapse-item" href="{{ url('admin/academic-excellence-award') }}">Academic Excellence</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="pl_courses.php">
            <i class="fa fa-award"></i>
            <span>Non-Academic Awards</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('admin/import-csv') }}">
            <i class="fa-solid fa-file-csv"></i>
            <span>Import CSV</span>
        </a>
    </li>
    <li
        class="nav-item {{ Request::is('admin/send-awardees-certificates/achievers-award') ||
        Request::is('admin/send-awardees-certificates/deans-list-award') ||
        Request::is('admin/send-awardees-certificates/presidents-list-award') ||
        Request::is('admin/send-awardees-certificates/academic-excellence-award')
            ? 'active'
            : '' }}">
        <a class="nav-link collapsed {{ Request::is('admin/send-awardees-certificates/achievers-award') ||
        Request::is('admin/send-awardees-certificates/deans-list-award') ||
        Request::is('admin/send-awardees-certificates/presidents-list-award') ||
        Request::is('admin/send-awardees-certificates/academic-excellence-award')
            ? ''
            : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fa-solid fa-certificate"></i>
            <span>Send Certificates</span>
        </a>
        <div id="collapsePages"
            class="collapse {{ Request::is('admin/send-awardees-certificates/achievers-award') ||
            Request::is('admin/send-awardees-certificates/deans-list-award') ||
            Request::is('admin/send-awardees-certificates/presidents-list-award') ||
            Request::is('admin/send-awardees-certificates/academic-excellence-award')
                ? 'show'
                : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item"
                    {{ Request::is('admin/send-awardees-certificates/achievers-award') ? 'active' : '' }}
                    href="{{ url('admin/send-awardees-certificates/achievers-award') }}">Achiever's Award</a>
                <a class="collapse-item"
                    {{ Request::is('admin/send-awardees-certificates/deans-list-award') ? 'active' : '' }}
                    href="{{ url('admin/send-awardees-certificates/deans-list-award') }}">Dean's
                    List</a>
                <a class="collapse-item"
                    {{ Request::is('admin/send-awardees-certificates/presidents-list-award') ? 'active' : '' }}
                    href="{{ url('admin/send-awardees-certificates/presidents-list-award') }}">President's List</a>
                <a class="collapse-item"
                    {{ Request::is('admin/send-awardees-certificates/academic-excellence-award') ? 'active' : '' }}
                    href="{{ url('admin/send-awardees-certificates/academic-excellence-award') }}">Academic
                    Excellence</a>
                <a class="collapse-item" href="">Non-Academic Excellence</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Module Management</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Modules</a>
                <a class="collapse-item" href="">Permissions Type</a>
                <a class="collapse-item" href="">Permissions</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="utilities-color.html">Roles</a>
                <a class="collapse-item" href="{{ url('admin/users') }}">Users</a>
                <a class="collapse-item" href="utilities-animation.html">Role Pernissions</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
