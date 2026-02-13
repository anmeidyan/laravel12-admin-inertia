<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('storage/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('storage/dist/css/custom.css')}}">
    @stack('style')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="javascript:;" class="nav-link" data-widget="control-sidebar"
                        onclick="document.getElementById('logout-form').submit()">
                        <i class="fas fa-sign-out-alt"></i> Log Out
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('storage/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @foreach($sideMenus as $menu)
                            @if($menu->children->count())
                                <li class="nav-item {{ request()->routeIs($menu->route) ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                                        <i class="nav-icon fas {{ $menu->icon }}"></i>
                                        <p>
                                            {{ $menu->name }}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @foreach($menu->children as $child)
                                            <li class="nav-item">
                                                <a href="{{ route($child->route) }}" class="nav-link {{ request()->routeIs($child->route) ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>{{ $child->name }}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route($menu->route) }}" class="nav-link {{ request()->routeIs($menu->route) ? 'active' : '' }}">
                                        <i class="nav-icon fas {{ $menu->icon }}"></i>
                                        <p>{{ $menu->name }}</p>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }}. All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0.0
                </div>
        </footer>
    </div>

    <script src="{{ asset('storage/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('storage/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('storage/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('storage/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ asset('storage/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('storage/dist/js/custom.js') }}"></script>
    @stack('scripts')
</body>

</html>