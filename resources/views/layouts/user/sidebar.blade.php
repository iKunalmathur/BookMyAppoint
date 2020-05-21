<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-icon rotate-n-15"></div>
            <div class="sidebar-brand-text mx-3"><span>Bookmyappoint.</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item" role="presentation"><a class="nav-link @yield('dashboardActive')" href="{{ route('user.home') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item" role="presentation"><a class="nav-link @yield('profileActive')" href="{{ route('user.profile.index') }}/"><i class="fas fa-user"></i><span>Profile</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link @yield('SlotActive')" href="{{ route('user.slot.index') }}/"><i class="fa fa-plus-square" aria-hidden="true"></i></i><span>Appointment Slot</span></a>
            </li>
            <li class="nav-item" role="presentation"><a class="nav-link @yield('ServiceActive')" href="{{ route('user.service.index') }}/"><i class="fa fa-cog" aria-hidden="true"></i><span>Service</span></a>
            </li>
            <li class="nav-item" role="presentation"><a class="nav-link @yield('AppointmentActive')" href="{{ route('user.appointment.index') }}/"><i class="fas fa-table" aria-hidden="true"></i><span>Appointments</span></a>
            </li>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>
