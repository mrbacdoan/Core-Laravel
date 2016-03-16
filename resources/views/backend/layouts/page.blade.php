<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="robots" content="noindex, follow">
    <meta name="robots" content="index, nofollow">
    <meta name="robots" content="noindex, nofollow">
    <title>
        {{ empty($title) ? '' : $title }}
    </title>
    <!-- =============== VENDOR STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('components/fontawesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('components/ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('components/adminlte/dist/css/AdminLTE.min.css')  }}">

    <link rel="stylesheet" href="{{ asset('components/adminlte/plugins/iCheck/flat/blue.css')  }}">

    <link href="{{asset('components/animate.css/animate.min.css')}}" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.css')  }}">

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    @yield('css')
</head>
<body class="hold-transition login-page">
<div class="wrapper">
    @yield('content')
    <div class="p-lg text-center">
        <span>&copy; 2015 {{ date('Y' > 2015) ? ' - ' . date('Y') : '' }} - IZee Media</span>
    </div>
</div>
@include('notifications.messageJS')
        <!-- =============== VENDOR SCRIPTS ===============-->
<script src="{{ asset('components/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('components/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{asset('components/noty/js/noty/packaged/jquery.noty.packaged.min.js')}}" type="text/javascript"></script>

<script src="{{ asset('assets/base.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/backend/js/backend.js') }}" type="text/javascript"></script>

@yield('js')
</body>
</html>