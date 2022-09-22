<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_home_page">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin/img/puplogomini.png') }}"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PUPT RMS</div>
    </a>

    <hr class="sidebar-divider my-0">


    <div class="sidebar-heading text-light mt-4">
        NAVIGATION PANE
    </div>

    <li class="nav-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
        <a class="nav-link align-middle" href="{{ url('user/dashboard') }}">
            <i class="fa-solid fa-house-chimney"></i>
            <span>Home</span>
        </a>
    </li>

    <!--Nav Item - Utilities Collapse Menu -->

    <li class="nav-item {{ Request::is('user/application-status/academic-award') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fa-solid fa-list-check"></i>
            <span>Application Status</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('user/application-status/academic-award') }}">Academic Award</a>
                <a class="collapse-item" href="{{ url('user/application-status/academic-excellence') }}">Academic
                    Excellence</a>
                <a class="collapse-item" href="">Non-Academic Award</a>
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
