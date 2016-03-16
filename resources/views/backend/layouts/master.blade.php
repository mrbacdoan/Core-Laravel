<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ empty($title) ? 'Trang quản trị' : $title }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('components/fontawesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('components/ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('components/adminlte/dist/css/AdminLTE.min.css')  }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('components/adminlte/dist/css/skins/_all-skins.min.css')  }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('components/adminlte/plugins/iCheck/flat/blue.css')  }}">
    <!-- Morris chart -->
    {{--<link rel="stylesheet" href="{{ asset('components/adminlte/plugins/morris/morris.css')  }}">--}}
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('components/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css')  }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('components/adminlte/plugins/datepicker/datepicker3.css')  }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('components/adminlte/plugins/daterangepicker/daterangepicker-bs3.css')  }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('components/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')  }}">

    <!-- Animate.css -->
    <link href="{{asset('components/animate.css/animate.min.css')}}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css')  }}">
    @yield('css')
</head>
<body>
<div class="wrapper">
    <header class="main-header">
        @include('backend.partials.top-bar')
    </header>
    <aside class="main-sidebar">
        @include('backend.partials.sidebar-left')
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ empty($title) ? '' : $title }}
                <small>{{ empty($subTitle) ? '' : $subTitle }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        @yield('content')
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 IZee Media</strong>
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
        @include('backend.partials.sidebar-right')
    </aside>
    <div class="control-sidebar-bg"></div>
</div>
@include('notifications.messageJS')
<script type="text/javascript">
    var BASE_URL = '{{url()}}';
    var _token = '{{ csrf_token() }}';
    var accounts = {
        avatar: '{{empty(Auth::getUser()->avatar) ? url(USER_AVATAR_DEFAULT) :url(Auth::getUser()->avatar)}}'
    };

    var accountUrl = {
        changeAvatar: "{{route('backend.account.change-avatar')}}"
    };
</script>
        <!-- =============== VENDOR SCRIPTS ===============-->
<!-- jQuery 2.1.4 -->
<script src="{{ asset('components/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('components/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- raphael.js -->
<script src="{{ asset('components/raphael/raphael-min.js') }}"></script>
<!-- Morris.js charts -->
{{--<script src="{{ asset('components/adminlte/plugins/morris/morris.min.js') }}"></script>--}}
<!-- Sparkline -->
<script src="{{ asset('components/adminlte/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('components/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('components/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('components/adminlte/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('components/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('components/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('components/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('components/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('components/adminlte/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('components/adminlte/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('components/adminlte/dist/js/demo.js') }}"></script>

<!-- Noty -->
<script src="{{asset('components/noty/js/noty/packaged/jquery.noty.packaged.min.js')}}" type="text/javascript"></script>

<!-- Cropbox-->
<script src="{{asset('assets/backend/js/cropbox-min.js')}}" type="text/javascript"></script>

<script src="{{ asset('assets/base.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/backend/js/backend.js') }}" type="text/javascript"></script>
@yield('js')
</body>
</html>