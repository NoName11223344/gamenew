<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assset/img/logo1.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assset/img/logo1.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Alowin247 Nhà Cái Đá Gà Thomo</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('dashboard/light-bootstrap-dashboard/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/light-bootstrap-dashboard/assets/css/light-bootstrap-dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin-lte/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-lte/select2-bootstrap4.min.css') }}">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('dashboard/light-bootstrap-dashboard/assets/css/demo.css') }}" rel="stylesheet" />
    <style>
        body{
            background: url("{{ asset('assset/img/background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }
        footer {
            display: none;
        }
        .card label {
            color: #000;
        }
        ::placeholder {
            color: #f87474 !important;
            opacity: 1; /* Firefox */
        }
        .main-panel{
            background-color: #2a323a;
            height: 100%;
        }
        .navbar{
            background-color: #2a323a;
        }
        .sidebar::after{
            background: linear-gradient(to bottom, #b10404 0%, #943bea 100%);
        }
    </style>
</head>

<body>
<div class="wrapper">
    @include('site.master.siderbar')
    @yield('content')
</div>
</body>
@include('site.master.livechat')
<!-- End of LiveChat code -->
<!--   Core JS Files   -->
<script src="{{ asset('dashboard/light-bootstrap-dashboard/assets/js/core/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboard/light-bootstrap-dashboard/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dashboard/light-bootstrap-dashboard/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{ asset('dashboard/light-bootstrap-dashboard/assets/js/plugins/bootstrap-switch.js') }}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="{{ asset('dashboard/light-bootstrap-dashboard/assets/js/plugins/chartist.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ asset('dashboard/light-bootstrap-dashboard/assets/js/plugins/bootstrap-notify.js') }}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{ asset('dashboard/light-bootstrap-dashboard/assets/js/light-bootstrap-dashboard.js?v=2.0.0') }} " type="text/javascript"></script>

<script src=" {{ asset('admin-lte/select2.full.min.js') }} "></script>

<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{ asset('dashboard/light-bootstrap-dashboard/assets/js/demo.js') }}"></script>

<script>
    $(function () {
        $('.select2').select2({ height: '50px', dropdownCssClass: "bigdrop" })
    })
</script>
</html>
