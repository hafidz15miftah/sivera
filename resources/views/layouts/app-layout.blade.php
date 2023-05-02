<!DOCTYPE html>
<html lang="id">

<!-- Head -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.ico')}}">
    <!-- Pignose Calender -->
    <link href="{{ asset('plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Load SweetAlert CSS -->
    <link rel="stylesheet" href="">
</head>

<body>

    <!-- Add Barang Modal -->
    @include('partials.barangmodal')
    <!-- Loading Progressbar -->
    @include('partials.loading')

    <!-- Main Wrapper -->
    <div id="main-wrapper">

        <!-- Navigation Header Logo -->
        @include('partials.navheaderlogo')

        <!-- Header -->
        @include('partials.header')

        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Site Content -->
        <div class="content-body">

            @yield('content')

        </div>

        <!-- Footer -->
        @include('partials.footer')
    </div>

    <!-- Script -->
    @include('partials.script')
    {{-- @include('sweetalert::alert') --}}


</body>

</html>
