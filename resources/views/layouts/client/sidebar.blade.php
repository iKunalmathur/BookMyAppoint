<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <div class="sidebar-brand-icon rotate-n-15"></div>
            <div class="sidebar-brand-text mx-3"><span>Bookmyappoint.</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item" role="presentation"><a class="nav-link @yield('dashboardActive')" href="{{ route('client.home') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link @yield('profileActive')" href="{{ route('client.profile.index') }}/"><i class="fas fa-user"></i><span>Profile</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="table.html"><i class="fas fa-table"></i><span>Table</span></a><a class="nav-link" href="setappointment.html"><i class="far fa-calendar-check"></i><span>set appointment</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="login.html"><i class="far fa-user-circle"></i><span>Login</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link" href="register.html"><i class="fas fa-user-circle"></i><span>Register</span></a></li>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>