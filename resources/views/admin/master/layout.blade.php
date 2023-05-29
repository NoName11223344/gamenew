<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('fontawesome-free-5-web/css/all.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('admin-lte/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/select2-bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('admin-lte/summernote-bs4.css') }}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin-lte/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin-lte/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin-lte/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin-lte/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin-lte/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin-lte/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin-lte/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
{{--  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  @include('admin.master.header')
  @include('admin.master.siderbar')
  <div class="content-wrapper">
    <section class="content">
    @yield('content')
    </section>
  </div>
</div>
@include('admin.master.form-delete')
<!-- ./wrapper -->

<!-- jQuery -->
<script src=" {{ asset('admin-lte/jquery.min.js') }} "></script>
<!-- jQuery UI 1.11.4 -->
<script src=" {{ asset('/admin-lte/jquery-ui.min.js') }} "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src=" {{ asset('fontawesome-free-5-web/js/all.js') }} "></script>

<!-- Bootstrap 4 -->
<script src=" {{ asset('admin-lte/bootstrap.bundle.min.js') }} "></script>
<!-- ChartJS -->
<script src=" {{ asset('admin-lte/Chart.min.js') }} "></script>
<!-- Sparkline -->
<script src=" {{ asset('admin-lte/sparkline.js') }} "></script>
<!-- JQVMap -->
<!-- <script src=" {{ asset('admin-lte/jquery.vmap.min.js') }} "></script>
<script src=" {{ asset('admin-lte/jquery.vmap.usa.js') }} "></script> -->
<!-- jQuery Knob Chart -->
<script src=" {{ asset('admin-lte/jquery.knob.min.js') }} "></script>
<!-- daterangepicker -->
<script src=" {{ asset('admin-lte/moment.min.js') }} "></script>
<script src=" {{ asset('admin-lte/daterangepicker.js') }} "></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src=" {{ asset('admin-lte/tempusdominus-bootstrap-4.min.js') }} "></script>
<!-- Summernote -->
<script src=" {{ asset('admin-lte/summernote-bs4.min.js') }} "></script>
<!-- overlayScrollbars -->
<script src=" {{ asset('admin-lte/jquery.overlayScrollbars.min.js') }} "></script>

<script src=" {{ asset('admin-lte/select2.full.min.js') }} "></script>
<!-- AdminLTE App -->
<script src=" {{ asset('admin-lte/adminlte.js') }} "></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=" {{ asset('admin-lte/dashboard.js') }} "></script>
<!-- AdminLTE for demo purposes -->
<script src=" {{ asset('admin-lte/demo.js') }} "></script>

@yield('js')

<script>
    $(function () {
        $('.select2').select2()
    })
    function deleteItem(e) {
        let url = $(e).attr('url');
        $('#form-delete').attr('action', url);

        if(confirm('Bạn có thật sự muốn xóa!')){
            $('#form-delete').submit();
        }
    }
</script>

<script>
    function acceptItem(e) {
        let url = $(e).attr('url');

        if(confirm('Bạn có thật sự muốn kích hoạt tài khoản này không!')){
            window.location.replace(url);
        }
    }
</script>
</body>
</html>
