@include('layouts.header')
<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
            <!-- <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-business-time"></i></div> -->
            <div class="sidebar-brand-icon rotate-n-15"><img src="{{ asset('assets/img/logo.png') }}" /></div>
            <div class="sidebar-brand-text mx-3"><span>HRIS Portal</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item"><a class="nav-link active" href="{{route('home')}}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="nav-item"><a class="nav-link" href="{{route(Auth::user()->roles->first()->name . '.profile',Auth::user()->employee_id)}}"><i class="fas fa-user"></i><span>Profile</span></a></li>
            @if (Auth::user()->hasRole(['admin','hr']))
            <li class="nav-item"><a class="nav-link" href="{{route(Auth::user()->roles->first()->name . '.logs')}}"><i class="fas fa-table"></i><span>Time Logs</span></a></li>
            @endif
            @if (Auth::user()->hasRole('admin'))
            <li class="nav-item"><a class="nav-link" href="{{route('admin.accounts')}}"><i class="fas fa-table"></i><span>Accounts</span></a></li>
            @endif
            <li class="nav-item"></li>
            <li class="nav-item"></li>
        </ul>
    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button" style="opacity: 0.77;"></button></div>
</nav>
<div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                    <span class="d-none d-lg-inline me-2 text-gray-600 small">{{ Auth::user()->employee_id }} {{ Auth::user()->first_name }}</span>
                                    <img class="border rounded-circle img-profile" src="{{Auth::user()->avatar()}}"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="{{route('hr.profile',Auth::user()->employee_id)}}">
                                        <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile</a><a class="dropdown-item" href="#">
                                            
                                        <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i> Activity log</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
@yield('content')
@include('layouts.footer')
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs-init.js') }}"></script>
    <script src="{{ asset('assets/js/Accordion-with-custom-design.js') }}"></script>
    <script src="{{ asset('assets/js/Animated-Type-Heading.js') }}"></script>
    <script src="{{ asset('assets/js/Animated-Typing-With-Blinking.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
</body>
</html>