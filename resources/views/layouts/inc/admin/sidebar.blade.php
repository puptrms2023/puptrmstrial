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

    @can('student list')
        <li class="nav-item {{ Request::is('admin/students') || Request::is('admin/students/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ url('admin/students') }}">
                <i class="fa fa-id-card"></i>
                <span>Students</span>
            </a>
        </li>
    @endcan
    @can('menu academic awards')
        <li
            class="nav-item {{ Request::is('admin/achievers-award') || Request::is('admin/achievers-award/*') || Request::is('admin/deans-list-award') || Request::is('admin/deans-list-award/*') || Request::is('admin/presidents-list-award') || Request::is('admin/presidents-list-award/*') || Request::is('admin/academic-excellence-award') || Request::is('admin/academic-excellence-award/*') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('admin/achievers-award') || Request::is('admin/achievers-award/*') || Request::is('admin/deans-list-award') || Request::is('admin/deans-list-award/*') || Request::is('admin/presidents-list-award') || Request::is('admin/presidents-list-award/*') || Request::is('admin/academic-excellence-award') || Request::is('admin/academic-excellence-award/*') ? '' : 'collapsed' }}"
                href="#" data-toggle="collapse" data-target="#academicAwardPages" aria-expanded="true"
                aria-controls="academicAwardPages">
                <i class="fas fa-award"></i>
                <span>Academic Awards</span>
            </a>
            <div id="academicAwardPages"
                class="collapse {{ Request::is('admin/achievers-award') || Request::is('admin/achievers-award/*') || Request::is('admin/deans-list-award') || Request::is('admin/deans-list-award/*') || Request::is('admin/presidents-list-award') || Request::is('admin/presidents-list-award/*') || Request::is('admin/academic-excellence-award') || Request::is('admin/academic-excellence-award/*') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('achievers list')
                        <a class="collapse-item {{ Request::is('admin/achievers-award') || Request::is('admin/achievers-award/*') ? 'active' : '' }}"
                            href="{{ url('admin/achievers-award') }}">Achiever's Award</a>
                    @endcan
                    @can('deans list list')
                        <a class="collapse-item {{ Request::is('admin/deans-list-award') || Request::is('admin/deans-list-award/*') ? 'active' : '' }}"
                            href="{{ url('admin/deans-list-award') }}">Dean's List</a>
                    @endcan
                    @can('presidents list list')
                        <a class="collapse-item {{ Request::is('admin/presidents-list-award') || Request::is('admin/presidents-list-award/*') ? 'active' : '' }}"
                            href="{{ url('admin/presidents-list-award') }}">President's List</a>
                    @endcan
                    @can('acad excellence list')
                        <a class="collapse-item {{ Request::is('admin/academic-excellence-award') || Request::is('admin/academic-excellence-award/*') ? 'active' : '' }}"
                            href="{{ url('admin/academic-excellence-award') }}">Academic Excellence</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan
    <li
        class="nav-item {{ Request::is('admin/non-academic-award/leadership-award') ||
        Request::is('admin/non-academic-award/leadership-award/*') ||
        Request::is('admin/non-academic-award/athlete-of-the-year') ||
        Request::is('admin/non-academic-award/athlete-of-the-year/*') ||
        Request::is('admin/non-academic-award/outstanding-organization-award') ||
        Request::is('admin/non-academic-award/outstanding-organization-award/*') ||
        Request::is('admin/non-academic-award/best-thesis-award') ||
        Request::is('admin/non-academic-award/best-thesis-award/*') ||
        Request::is('admin/non-academic-award/graduating-organization-presidents') ||
        Request::is('admin/non-academic-award/graduating-organization-presidents/*') ||
        Request::is('admin/non-academic-award/graduating-sa') ||
        Request::is('admin/non-academic-award/graduating-sa/*') ||
        Request::is('admin/non-academic-award/outside-competition') ||
        Request::is('admin/non-academic-award/outside-competition/*') ||
        Request::is('admin/non-academic-award/graduating-sa') ||
        Request::is('admin/non-academic-award/graduating-sa/*') ||
        Request::is('admin/non-academic-award/pupt-dance-troupe') ||
        Request::is('admin/non-academic-award/pupt-dance-troupe/*') ||
        Request::is('admin/non-academic-award/pupt-choral-troupe') ||
        Request::is('admin/non-academic-award/pupt-choral-troupe/*')
            ? 'active'
            : '' }}">
        <a class="nav-link {{ Request::is('admin/non-academic-award/leadership-award') ||
        Request::is('admin/non-academic-award/leadership-award/*') ||
        Request::is('admin/non-academic-award/athlete-of-the-year') ||
        Request::is('admin/non-academic-award/athlete-of-the-year/*') ||
        Request::is('admin/non-academic-award/outstanding-organization-award') ||
        Request::is('admin/non-academic-award/outstanding-organization-award/*') ||
        Request::is('admin/non-academic-award/best-thesis-award') ||
        Request::is('admin/non-academic-award/best-thesis-award/*') ||
        Request::is('admin/non-academic-award/graduating-organization-presidents') ||
        Request::is('admin/non-academic-award/graduating-organization-presidents/*') ||
        Request::is('admin/non-academic-award/graduating-sa') ||
        Request::is('admin/non-academic-award/graduating-sa/*') ||
        Request::is('admin/non-academic-award/outside-competition') ||
        Request::is('admin/non-academic-award/outside-competition/*') ||
        Request::is('admin/non-academic-award/graduating-sa') ||
        Request::is('admin/non-academic-award/graduating-sa/*') ||
        Request::is('admin/non-academic-award/pupt-dance-troupe') ||
        Request::is('admin/non-academic-award/pupt-dance-troupe/*') ||
        Request::is('admin/non-academic-award/pupt-choral-troupe') ||
        Request::is('admin/non-academic-award/pupt-choral-troupe/*')
            ? ''
            : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#nonAcademicPages" aria-expanded="true"
            aria-controls="nonAcademicPages">
            <i class="fas fa-award"></i>
            <span>Non Academic Awards</span>
        </a>
        <div id="nonAcademicPages"
            class="collapse {{ Request::is('admin/non-academic-award/leadership-award') ||
            Request::is('admin/non-academic-award/leadership-award/*') ||
            Request::is('admin/non-academic-award/athlete-of-the-year') ||
            Request::is('admin/non-academic-award/athlete-of-the-year/*') ||
            Request::is('admin/non-academic-award/outstanding-organization-award') ||
            Request::is('admin/non-academic-award/outstanding-organization-award/*') ||
            Request::is('admin/non-academic-award/best-thesis-award') ||
            Request::is('admin/non-academic-award/best-thesis-award/*') ||
            Request::is('admin/non-academic-award/graduating-organization-presidents') ||
            Request::is('admin/non-academic-award/graduating-organization-presidents/*') ||
            Request::is('admin/non-academic-award/graduating-sa') ||
            Request::is('admin/non-academic-award/graduating-sa/*') ||
            Request::is('admin/non-academic-award/outside-competition') ||
            Request::is('admin/non-academic-award/outside-competition/*') ||
            Request::is('admin/non-academic-award/graduating-sa') ||
            Request::is('admin/non-academic-award/graduating-sa/*') ||
            Request::is('admin/non-academic-award/pupt-dance-troupe') ||
            Request::is('admin/non-academic-award/pupt-dance-troupe/*') ||
            Request::is('admin/non-academic-award/pupt-choral-troupe') ||
            Request::is('admin/non-academic-award/pupt-choral-troupe/*')
                ? 'show'
                : '' }}"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <div class="flex-column flex-nowrap">

                    <a class="collapse-item {{ Request::is('admin/non-academic-award/leadership-award') || Request::is('admin/non-academic-award/leadership-award/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/leadership-award') }}">Leadership
                        Award</a>
                    <a class="collapse-item {{ Request::is('admin/non-academic-award/athlete-of-the-year') || Request::is('admin/non-academic-award/athlete-of-the-year/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/athlete-of-the-year') }}">Athlete
                        of the Year
                        Award</a>
                    <a class="collapse-item {{ Request::is('admin/non-academic-award/outstanding-organization-award') || Request::is('admin/non-academic-award/outstanding-organization-award/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/outstanding-organization-award') }}">Outstanding
                        Organization<br> Award</a>
                    <a class="collapse-item {{ Request::is('admin/non-academic-award/best-thesis-award') || Request::is('admin/non-academic-award/best-thesis-award/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/best-thesis-award') }}">Best Thesis
                        Award</a>
                    <a class="collapse-item {{ Request::is('admin/non-academic-award/graduating-organization-presidents') || Request::is('admin/non-academic-award/graduating-organization-presidents/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/graduating-organization-presidents') }}">Graduating
                        Organization<br> Presidents</a>
                    <a class="collapse-item {{ Request::is('admin/non-academic-award/graduating-sa') || Request::is('admin/non-academic-award/graduating-sa/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/graduating-sa') }}">Graduating
                        Student<br> Assistants</a>
                    <a class="collapse-item {{ Request::is('admin/non-academic-award/outside-competition') || Request::is('admin/non-academic-award/outside-competition/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/outside-competition') }}">Outside
                        Competitions</a>
                    <a class="collapse-item {{ Request::is('admin/non-academic-award/pupt-dance-troupe') || Request::is('admin/non-academic-award/pupt-dance-troupe/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/pupt-dance-troupe') }}">Graduating
                        member<br> of PUPT Dance Troupe</a>
                    <a class="collapse-item {{ Request::is('admin/non-academic-award/pupt-choral-troupe') || Request::is('admin/non-academic-award/pupt-choral-troupe/*') ? 'active' : '' }}"
                        href="{{ url('admin/non-academic-award/pupt-choral-troupe') }}">Graduating
                        member<br> of PUPT Choral Group
                </div>
            </div>
        </div>
    </li>
    @can('csv list')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('admin/import-csv') }}">
                <i class="fa-solid fa-file-csv"></i>
                <span>Import CSV</span>
            </a>
        </li>
    @endcan
    @can('menu send certificate')
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
                href="#" data-toggle="collapse" data-target="#sendCertificatePages" aria-expanded="true"
                aria-controls="sendCertificatePages">
                <i class="fa-solid fa-certificate"></i>
                <span>Send Certificates</span>
            </a>
            <div id="sendCertificatePages"
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
    @endcan
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#modulePages"
            aria-expanded="true" aria-controls="modulePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Module Management</span>
        </a>
        <div id="modulePages" class="collapse" aria-labelledby="" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Modules</a>
                <a class="collapse-item" href="">Permissions Type</a>
                <a class="collapse-item" href="">Permissions</a>
            </div>
        </div>
    </li>
    @can('menu utilities')
        <li
            class="nav-item {{ Request::is('admin/roles') || Request::is('admin/roles/create') || Request::is('admin/roles/*') || Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/users/*') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('admin/roles') || Request::is('admin/roles/create') || Request::is('admin/roles/*') || Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/users/*') ? '' : 'collapsed' }}"
                href="#" data-toggle="collapse" data-target="#utilitiesPges" aria-expanded="true"
                aria-controls="utilitiesPges">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="utilitiesPges"
                class="collapse {{ Request::is('admin/roles') ||
                Request::is('admin/roles/create') ||
                Request::is('admin/roles/*') ||
                Request::is('admin/users') ||
                Request::is('admin/users/create') ||
                Request::is('admin/users/*')
                    ? 'show'
                    : '' }}"
                aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('role list')
                        <a class="collapse-item {{ Request::is('admin/roles') || Request::is('admin/roles/create') || Request::is('admin/roles/*') ? 'active' : '' }}"
                            href="{{ url('admin/roles') }}">Roles and Permissions</a>
                    @endcan
                    @can('user list')
                        <a class="collapse-item {{ Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/users/*') ? 'active' : '' }}"
                            href="{{ url('admin/users') }}">Users</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    <!-- Heading -->
    <div class="sidebar-heading">
        PROGRAMS
    </div>
    @can('menu calendar')
        <li class="nav-item {{ Request::is('admin/calendar') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ url('admin/calendar') }}">
                <i class="fa fa-id-card"></i>
                <span>Calendar of Events</span>
            </a>
        </li>
    @endcan
    @can('gallery list')
        <li class="nav-item {{ Request::is('admin/students') || Request::is('admin/students/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ url('admin/galleries') }}">
                <i class="fa fa-id-card"></i>
                <span>Recognition of Gallery</span>
            </a>
        </li>
    @endcan

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
