<!DOCTYPE html>
<html lang="@yield('lang', config('app.locale', 'en'))">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title', config('app.name', 'AdminLTE'))</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  @section('styles')
  <link href="{{ mix('/css/admin-lte.css') }}" rel="stylesheet">
  @show

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link href="{{ url('/adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Ionicons -->
    <link href="{{ url('/adminlte/bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <!-- daterange picker -->
    <link href="{{ url('/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('/theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap datepicker -->
    <link href="{{ url('/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{{ url('/adminlte/plugins/iCheck/all.css') }}" rel="stylesheet">
    <!-- Bootstrap Color Picker -->
    <link href="{{ url('/adminlte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <!-- Bootstrap time Picker -->
    <link href="{{ url('/adminlte/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ url('/adminlte/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link href="{{ url('/adminlte/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{ url('/adminlte/dist/css/skins/_all-skins.min.css') }}" rel="stylesheet">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @stack('head')
</head>

<body class="hold-transition fixed skin-{{ config('admin-lte.skin', 'blue') }} {{ config('admin-lte.layout', 'sidebar-mini') }}">
  <div id="app" class="wrapper">

    <!-- Main Header -->
    @include('admin-lte::layouts.main-header.main')
    <!-- Left side column. contains the logo and sidebar -->
    @include('admin-lte::layouts.main-sidebar.main')

    <!-- Content Wrapper. Contains page content -->
    @include('admin-lte::layouts.content-wrapper.main')

    <!-- Main Footer -->
    @include('admin-lte::layouts.main-footer.main')

    <!-- Control Sidebar -->
    {{-- @include('admin-lte::layouts.control-sidebar.main') --}}
  </div>
  @section('scripts')
  <script src="{{ mix('/js/manifest.js') }}" charset="utf-8"></script>
  <script src="{{ mix('/js/vendor.js') }}" charset="utf-8"></script>
  <script src="{{ mix('/js/admin-lte.js') }}" charset="utf-8"></script>
  <!-- jQuery 3 -->
  <script src="{{ url('/adminlte/bower_components/jquery/dist/jquery.min.js') }}" ></script>
  
  <!-- Select2 -->
  <script src="{{ url('/adminlte/bower_components/select2/dist/js/select2.full.min.js') }}" ></script>
  <!-- InputMask -->
  <script src="{{ url('/adminlte/plugins/input-mask/jquery.inputmask.js') }}" ></script>
  <script src="{{ url('/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" ></script>
  <script src="{{ url('/adminlte/plugins/input-mask/jquery.inputmask.extensions.js') }}" ></script>
  <!-- DataTables -->
  <script src="{{ url('/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <!-- date-range-picker -->
  <script src="{{ url('/adminlte/bower_components/moment/min/moment.min.js') }}" ></script>
  <script src="{{ url('/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}" ></script>
  <!-- bootstrap datepicker -->
  <script src="{{ url('/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" ></script>
  <!-- bootstrap color picker -->
  <script src="{{ url('/adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}" ></script>
  <!-- bootstrap time picker -->
  <script src="{{ url('/adminlte/plugins/timepicker/bootstrap-timepicker.min.js') }}" ></script>
  <!-- SlimScroll -->
  <script src="{{ url('/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}" ></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ url('/adminlte/plugins/iCheck/icheck.min.js') }}" ></script>
  <!-- FastClick -->
  <script src="{{ url('/adminlte/bower_components/fastclick/lib/fastclick.js') }}" ></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ url('/adminlte/dist/js/demo.js') }}" ></script>   
  <script>
    $(function () {
                $('#tableRequests').DataTable({
                  'paging'      : true,
                  'lengthChange': true,
                  'searching'   : true,
                  'ordering'    : true,
                  'info'        : true,
                  'autoWidth'   : true
                })
            })
  </script>
  @show
  @stack('body')
</body>
</html>
