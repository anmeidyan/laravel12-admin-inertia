<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @if(request()->routeIs('admin.*'))
            <!-- CSS ADMIN PANEL -->
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
        @else
            <!-- CSS APP -->
        @endif

        @viteReactRefresh
        @vite('resources/js/app.jsx')
        @inertiaHead
    </head>
    <body>
        @inertia

        @if(request()->routeIs('admin.*'))
            <!-- JS ADMIN PANEL -->
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
        @else
            <!-- JS APP -->
        @endif
    </body>
</html>