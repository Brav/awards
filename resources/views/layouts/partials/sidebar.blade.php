Sidebar -->
<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="bg-header-dark">
        <div class="content-header bg-white-10">
            <!-- Logo -->
            <a class="font-w600 text-white tracking-wide" href="/">
                <span class="smini-visible">
                    <img src="{{ asset('media/favicons/favicon.png')}}" alt="" class="img-fluid" style="max-height: 32px">
                </span>
                <span class="smini-hidden">
                    <img src="{{ asset('media/logos/logo-white.png')}}" alt="" class="img-fluid" style="max-height: 32px">
                </span>
            </a>
            <!-- END Logo -->

        </div>
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll">
    <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}">
                        <i class="nav-main-link-icon fa fa-location-arrow"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>

                @auth



                @if (auth()->user()->admin)
                    <li class="nav-main-heading">Admin Options</li>

                    <li class="nav-main-heading">Users</li>

                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('users.index') }}">
                            <i class="nav-main-link-icon fa fa-folder-open"></i>
                            <span class="nav-main-link-name">Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('users.create') }}">
                            <i class="nav-main-link-icon fa fa-folder-open"></i>
                            <span class="nav-main-link-name">Add New</span>
                        </a>
                    </li>
                    <li class="nav-main-heading">Clinics</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('clinics.index') }}">
                            <i class="nav-main-link-icon fa fa-folder-open"></i>
                            <span class="nav-main-link-name">Manage Clinics</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('clinics.create') }}">
                            <i class="nav-main-link-icon fa fa-folder-open"></i>
                            <span class="nav-main-link-name">Add New</span>
                        </a>
                    </li>

                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('roles.index') }}">
                            <i class="nav-main-link-icon fa fa-folder-open"></i>
                            <span class="nav-main-link-name">Manage Roles</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('user-import.index') }}">
                            <i class="nav-main-link-icon fa fa-folder-open"></i>
                            <span class="nav-main-link-name">Import Users</span>
                        </a>
                    </li>

                    <li class="nav-main-heading">Nomination Categories</li>

                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('nominations.index') }}">
                            <i class="nav-main-link-icon fa fa-folder-open"></i>
                            <span class="nav-main-link-name">Manage Nomination Categories</span>
                        </a>
                    </li>

                    <li class="nav-main-heading">Departments</li>

                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{ route('departments.index') }}">
                            <i class="nav-main-link-icon fa fa-folder-open"></i>
                            <span class="nav-main-link-name">Manage Departments</span>
                        </a>
                    </li>

                @endif

                @endauth

            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar
