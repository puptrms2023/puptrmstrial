<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_home_page">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/puplogomini.png') }}"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PUPT AAAS</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link align-middle" href="{{url('user/dashboard')}}">
            Welcome, Super Admin
    </li>

    <div class="sidebar-heading">
        NAVIGATION PANE
    </div>

    <li class="nav-item active">
        <i class="fa fa-home" aria-hidden="true"></i>
        <span>Home</span>
        </a>
        <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div> -->
    </li>

    <!--Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="">
            <i class="fa fa-id-card"></i>
            <span>Users</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="achievers_courses.php">
            <i class="fa fa-award"></i>
            <span>Achiever Awardees</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="pl_courses.php">
            <i class="fa fa-award"></i>
            <span>President's Listers</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="dl_courses.php">
            <i class="fa fa-award"></i>
            <span>Dean's Listers</span>
        </a>
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
                <a class="btn btn-primary" href="{{ route('logout')}}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>