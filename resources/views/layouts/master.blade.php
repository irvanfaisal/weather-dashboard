<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{config('app.name')}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ URL::asset('niceadmin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('niceadmin/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('niceadmin/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('niceadmin/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

    @yield('head')
<!-- =======================================================
* Template Name: NiceAdmin
* Updated: Mar 09 2023 with Bootstrap v5.2.3
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->
</head>

<body>
    @include('layouts.header')
    @include('layouts.sidebar')
    @yield('content')
    @include('layouts.footer')

    <!-- Vendor JS Files -->
    <script type="text/javascript" src="{{ URL::asset('niceadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Template Main JS File -->
    <script type="text/javascript" src="{{ URL::asset('niceadmin/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    @yield('javascript')
</body>

</html>