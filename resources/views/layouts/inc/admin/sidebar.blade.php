<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin/img/' . getLogo()) }}" width="43px" height="41px"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ getSystemAcronym() }}</div>

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
    @can('menu csv')
        <li class="nav-item {{ Request::is('admin/import-csv') || Request::is('admin/parse-data') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('admin/import-csv') || Request::is('admin/parse-data') ? '' : 'collapsed' }}"
                href="#" data-toggle="collapse" data-target="#csvPages" aria-expanded="true" aria-controls="csvPages">
                <i class="fa-solid fa-file-csv"></i>
                <span>CSV</span>
            </a>
            <div id="csvPages"
                class="collapse {{ Request::is('admin/import-csv') || Request::is('admin/parse-data') ? 'show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('csv list')
                        <a class="collapse-item {{ Request::is('admin/import-csv') ? 'active' : '' }}"
                            href="{{ url('admin/import-csv') }}">Import CSV</a>
                    @endcan
                    @can('parse list')
                        <a class="collapse-item {{ Request::is('admin/parse-data') ? 'active' : '' }}"
                            href="{{ url('admin/parse-data') }}">Parse Data</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan
    @can('record list')
        <li class="nav-item {{ Request::is('admin/records') || Request::is('admin/records/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ url('admin/records') }}">
                <i class="fa-solid fa-clipboard"></i>
                <span>Recognition Records</span>
            </a>
        </li>
    @endcan
    @can('menu academic awards')
        <li
            class="nav-item {{ Request::is('admin/achievers-award') ||
            Request::is('admin/achievers-award/*') ||
            Request::is('admin/archive/achievers-award/*') ||
            Request::is('admin/archive-all/achievers-award') ||
            Request::is('admin/deans-list-award') ||
            Request::is('admin/deans-list-award/*') ||
            Request::is('admin/archive/deans-list-award/*') ||
            Request::is('admin/archive-all/deans-list-award') ||
            Request::is('admin/presidents-list-award') ||
            Request::is('admin/presidents-list-award/*') ||
            Request::is('admin/archive/presidents-list-award/*') ||
            Request::is('admin/archive-all/presidents-list-award') ||
            Request::is('admin/academic-excellence-award') ||
            Request::is('admin/academic-excellence-award/*') ||
            Request::is('admin/archive/academic-excellence-award/*') ||
            Request::is('admin/archive-all/academic-excellence-award')
                ? 'active'
                : '' }}">
            <a class="nav-link {{ Request::is('admin/achievers-award') ||
            Request::is('admin/achievers-award/*') ||
            Request::is('admin/archive/achievers-award/*') ||
            Request::is('admin/archive-all/achievers-award') ||
            Request::is('admin/deans-list-award') ||
            Request::is('admin/deans-list-award/*') ||
            Request::is('admin/deans-list-award/*') ||
            Request::is('admin/archive/deans-list-award/*') ||
            Request::is('admin/presidents-list-award') ||
            Request::is('admin/presidents-list-award/*') ||
            Request::is('admin/archive/presidents-list-award/*') ||
            Request::is('admin/archive-all/presidents-list-award') ||
            Request::is('admin/academic-excellence-award') ||
            Request::is('admin/academic-excellence-award/*') ||
            Request::is('admin/archive/academic-excellence-award/*') ||
            Request::is('admin/archive-all/academic-excellence-award')
                ? ''
                : 'collapsed' }}"
                href="#" data-toggle="collapse" data-target="#academicAwardPages" aria-expanded="true"
                aria-controls="academicAwardPages">
                <i class="fas fa-award"></i>
                <span>Academic Awards</span>
            </a>
            <div id="academicAwardPages"
                class="collapse {{ Request::is('admin/achievers-award') ||
                Request::is('admin/achievers-award/*') ||
                Request::is('admin/archive/achievers-award/*') ||
                Request::is('admin/archive-all/achievers-award') ||
                Request::is('admin/deans-list-award') ||
                Request::is('admin/deans-list-award/*') ||
                Request::is('admin/archive/deans-list-award/*') ||
                Request::is('admin/archive-all/deans-list-award') ||
                Request::is('admin/presidents-list-award') ||
                Request::is('admin/presidents-list-award/*') ||
                Request::is('admin/archive/presidents-list-award/*') ||
                Request::is('admin/archive-all/presidents-list-award') ||
                Request::is('admin/academic-excellence-award') ||
                Request::is('admin/academic-excellence-award/*') ||
                Request::is('admin/archive/academic-excellence-award/*') ||
                Request::is('admin/archive-all/academic-excellence-award')
                    ? 'show'
                    : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('achievers list')
                        <a class="collapse-item {{ Request::is('admin/achievers-award') ||
                        Request::is('admin/achievers-award/*') ||
                        Request::is('admin/archive/achievers-award/*') ||
                        Request::is('admin/archive-all/achievers-award')
                            ? 'active'
                            : '' }}"
                            href="{{ url('admin/achievers-award') }}">Achiever's Award</a>
                    @endcan
                    @can('deans list list')
                        <a class="collapse-item {{ Request::is('admin/deans-list-award') ||
                        Request::is('admin/deans-list-award/*') ||
                        Request::is('admin/archive/deans-list-award/*') ||
                        Request::is('admin/archive-all/deans-list-award')
                            ? 'active'
                            : '' }}"
                            href="{{ url('admin/deans-list-award') }}">Dean's List</a>
                    @endcan
                    @can('presidents list list')
                        <a class="collapse-item {{ Request::is('admin/presidents-list-award') ||
                        Request::is('admin/presidents-list-award/*') ||
                        Request::is('admin/archive/presidents-list-award/*') ||
                        Request::is('admin/archive-all/presidents-list-award')
                            ? 'active'
                            : '' }}"
                            href="{{ url('admin/presidents-list-award') }}">President's List</a>
                    @endcan
                    @can('acad excellence list')
                        <a class="collapse-item {{ Request::is('admin/academic-excellence-award') ||
                        Request::is('admin/academic-excellence-award/*') ||
                        Request::is('admin/archive/academic-excellence-award/*') ||
                        Request::is('admin/archive-all/academic-excellence-award')
                            ? 'active'
                            : '' }}"
                            href="{{ url('admin/academic-excellence-award') }}">Academic Excellence</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan
    @can('non-academic award list')
        <li
            class="nav-item {{ Request::is('admin/non-academic-award') ||
            Request::is('admin/non-academic-award/*') ||
            Request::is('admin/archive/non-academic-award/*') ||
            Request::is('admin/archive-all/non-academic-award')
                ? 'active'
                : '' }}">
            <a class="nav-link collapsed" href="{{ url('admin/non-academic-award') }}">
                <i class="fas fa-award"></i>
                <span>Non Academic Awards</span>
            </a>
        </li>
    @endcan
    @can('menu send certificate')
        <li
            class="nav-item {{ Request::is('admin/send-awardees-certificates/achievers-award') ||
            Request::is('admin/send-awardees-certificates/deans-list-award') ||
            Request::is('admin/send-awardees-certificates/deans-list-award/*') ||
            Request::is('admin/send-awardees-certificates/deans-list-award/*') ||
            Request::is('admin/send-awardees-certificates/presidents-list-award') ||
            Request::is('admin/send-awardees-certificates/presidents-list-award/*') ||
            Request::is('admin/send-awardees-certificates/academic-excellence-award') ||
            Request::is('admin/send-awardees-certificates/academic-excellence-award/*') ||
            Request::is('admin/send-awardees-certificates/non-academic-award') ||
            Request::is('admin/send-awardees-certificates/non-academic-award/*')
                ? 'active'
                : '' }}">
            <a class="nav-link collapsed {{ Request::is('admin/send-awardees-certificates/achievers-award') ||
            Request::is('admin/send-awardees-certificates/achievers-award/*') ||
            Request::is('admin/send-awardees-certificates/deans-list-award') ||
            Request::is('admin/send-awardees-certificates/deans-list-award/*') ||
            Request::is('admin/send-awardees-certificates/presidents-list-award') ||
            Request::is('admin/send-awardees-certificates/presidents-list-award/*') ||
            Request::is('admin/send-awardees-certificates/academic-excellence-award') ||
            Request::is('admin/send-awardees-certificates/academic-excellence-award/*') ||
            Request::is('admin/send-awardees-certificates/non-academic-award') ||
            Request::is('admin/send-awardees-certificates/non-academic-award/*')
                ? ''
                : 'collapsed' }}"
                href="#" data-toggle="collapse" data-target="#sendCertificatePages" aria-expanded="true"
                aria-controls="sendCertificatePages">
                <i class="fa-solid fa-certificate"></i>
                <span>Send Certificates</span>
            </a>
            <div id="sendCertificatePages"
                class="collapse {{ Request::is('admin/send-awardees-certificates/achievers-award') ||
                Request::is('admin/send-awardees-certificates/achievers-award/*') ||
                Request::is('admin/send-awardees-certificates/deans-list-award') ||
                Request::is('admin/send-awardees-certificates/deans-list-award/*') ||
                Request::is('admin/send-awardees-certificates/presidents-list-award') ||
                Request::is('admin/send-awardees-certificates/presidents-list-award/*') ||
                Request::is('admin/send-awardees-certificates/academic-excellence-award') ||
                Request::is('admin/send-awardees-certificates/academic-excellence-award/*') ||
                Request::is('admin/send-awardees-certificates/non-academic-award') ||
                Request::is('admin/send-awardees-certificates/non-academic-award/*')
                    ? 'show'
                    : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item
                        {{ Request::is('admin/send-awardees-certificates/achievers-award') || Request::is('admin/send-awardees-certificates/achievers-award/*') ? 'active' : '' }}"
                        href="{{ url('admin/send-awardees-certificates/achievers-award') }}">Achiever's Award</a>
                    <a class="collapse-item
                        {{ Request::is('admin/send-awardees-certificates/deans-list-award') || Request::is('admin/send-awardees-certificates/deans-list-award/*') ? 'active' : '' }}"
                        href="{{ url('admin/send-awardees-certificates/deans-list-award') }}">Dean's
                        List</a>
                    <a class="collapse-item
                        {{ Request::is('admin/send-awardees-certificates/presidents-list-award') || Request::is('admin/send-awardees-certificates/presidents-list-award/*') ? 'active' : '' }}"
                        href="{{ url('admin/send-awardees-certificates/presidents-list-award') }}">President's List</a>
                    <a class="collapse-item
                        {{ Request::is('admin/send-awardees-certificates/academic-excellence-award') || Request::is('admin/send-awardees-certificates/academic-excellence-award/*') ? 'active' : '' }}"
                        href="{{ url('admin/send-awardees-certificates/academic-excellence-award') }}">Academic
                        Excellence</a>
                    <a class="collapse-item
                        {{ Request::is('admin/send-awardees-certificates/non-academic-award') || Request::is('admin/send-awardees-certificates/non-academic-award/*') ? 'active' : '' }}"
                        href={{ url('admin/send-awardees-certificates/non-academic-award') }}>Non-Academic Award</a>
                </div>
            </div>
        </li>
    @endcan
    @can('menu module')
        <li
            class="nav-item {{ Request::is('admin/maintenance/form') || Request::is('admin/maintenance/*') || Request::is('admin/maintenance/programs') || Request::is('admin/maintenance/programs/*') || Request::is('admin/maintenance/about') || Request::is('admin/maintenance/about/*') || Request::is('admin/maintenance/signatures') || Request::is('admin/maintenance/signatures/*') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('admin/maintenance/form') || Request::is('admin/maintenance/*') || Request::is('admin/maintenance/programs') || Request::is('admin/maintenance/programs/*') || Request::is('admin/maintenance/about') || Request::is('admin/maintenance/about/*') || Request::is('admin/maintenance/signatures') || Request::is('admin/maintenance/signatures/*') ? '' : 'collapsed' }}"
                href="#" data-toggle="collapse" data-target="#modulePages" aria-expanded="true"
                aria-controls="modulePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Module Management</span>
            </a>
            <div id="modulePages"
                class="collapse {{ Request::is('admin/maintenance/form') || Request::is('admin/maintenance/*') || Request::is('admin/maintenance/programs') || Request::is('admin/maintenance/programs/*') || Request::is('admin/maintenance/about') || Request::is('admin/maintenance/about/*') || Request::is('admin/maintenance/signatures') || Request::is('admin/maintenance/signatures/*') ? 'show' : '' }}"
                aria-labelledby="" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('form list')
                        <a class="collapse-item {{ Request::is('admin/maintenance/form') || Request::is('admin/maintenance/form/*') ? 'active' : '' }}"
                            href="{{ url('admin/maintenance/form') }}">Form</a>
                    @endcan
                    @can('program list')
                        <a class="collapse-item {{ Request::is('admin/maintenance/programs') || Request::is('admin/maintenance/programs/*') ? 'active' : '' }}"
                            href="{{ url('admin/maintenance/programs') }}">Programs</a>
                    @endcan
                    @can('subject list')
                        <a class="collapse-item {{ Request::is('admin/maintenance/subjects') || Request::is('admin/maintenance/subjects/*') ? 'active' : '' }}"
                            href="{{ url('admin/maintenance/subjects') }}">Subjects</a>
                    @endcan
                    @can('subject list')
                        <a class="collapse-item {{ Request::is('admin/maintenance/course-list') || Request::is('admin/maintenance/course-list/*') ? 'active' : '' }}"
                            href="{{ url('admin/maintenance/course-list') }}">Course List</a>
                    @endcan
                    @can('about view')
                        <a class="collapse-item {{ Request::is('admin/maintenance/about') || Request::is('admin/maintenance/about/*') ? 'active' : '' }}"
                            href="{{ url('admin/maintenance/about') }}">About</a>
                    @endcan
                    @can('signature list')
                        <a class="collapse-item {{ Request::is('admin/maintenance/signatures') || Request::is('admin/maintenance/signatures/*') ? 'active' : '' }}"
                            href="{{ url('admin/maintenance/signatures') }}">Signature</a>
                    @endcan
                    @can('signature list')
                        <a class="collapse-item {{ Request::is('admin/maintenance/data-retention') || Request::is('admin/maintenance/data-retention/*') ? 'active' : '' }}"
                            href="{{ url('admin/maintenance/data-retention') }}">Data Retention</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan
    @can('menu utilities')
        <li
            class="nav-item {{ Request::is('admin/roles') || Request::is('admin/roles/*') || Request::is('admin/users') || Request::is('admin/users/*') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('admin/roles') || Request::is('admin/roles/*') || Request::is('admin/users') || Request::is('admin/users/*') ? '' : 'collapsed' }}"
                href="#" data-toggle="collapse" data-target="#utilitiesPges" aria-expanded="true"
                aria-controls="utilitiesPges">
                <i class="fas fa-fw fa-wrench"></i>
                <span>User Management</span>
            </a>
            <div id="utilitiesPges"
                class="collapse {{ Request::is('admin/roles') ||
                Request::is('admin/roles/*') ||
                Request::is('admin/users') ||
                Request::is('admin/users/*')
                    ? 'show'
                    : '' }}"
                aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('role list')
                        <a class="collapse-item {{ Request::is('admin/roles') || Request::is('admin/roles/*') ? 'active' : '' }}"
                            href="{{ url('admin/roles') }}">Roles and Permissions</a>
                    @endcan
                    @can('user list')
                        <a class="collapse-item {{ Request::is('admin/users') || Request::is('admin/users/*') ? 'active' : '' }}"
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
        <li
            class="nav-item {{ Request::is('admin/calendar-events') || Request::is('admin/calendar-events/*') || Request::is('admin/calendar-events/calendar') ? 'active' : '' }}">
            <a class="nav-link {{ Request::is('admin/calendar-events') || Request::is('admin/calendar-events/*') || Request::is('admin/calendar-events/calendar') ? '' : 'collapsed' }}"
                href="#" data-toggle="collapse" data-target="#eventsPages" aria-expanded="true"
                aria-controls="eventsPages">
                <i class="fa-solid fa-calendar-week"></i>
                <span>Calendar of Events</span>
            </a>
            <div id="eventsPages"
                class="collapse {{ Request::is('admin/calendar-events') ||
                Request::is('admin/calendar-events/*') ||
                Request::is('admin/calendar-events/calendar')
                    ? 'show'
                    : '' }}"
                aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('events list')
                        <a class="collapse-item {{ Request::is('admin/calendar-events') || Request::is('admin/alendar-events/*') ? 'active' : '' }}"
                            href="{{ url('admin/calendar-events') }}">Events</a>
                    @endcan
                    @can('calendar show')
                        <a class="collapse-item {{ Request::is('admin/calendar-events/calendar') ? 'active' : '' }}"
                            href="{{ url('admin/calendar-events/calendar') }}">Calendar</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan
    @can('gallery list')
        <li class="nav-item {{ Request::is('admin/galleries') || Request::is('admin/galleries/*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="{{ url('admin/galleries') }}">
                <i class="fa-solid fa-images"></i>
                <span>Recognition Gallery</span>
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
