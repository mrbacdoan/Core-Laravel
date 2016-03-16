<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('messages.404.title') }}</title>

    <link href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
        }

        .container1 {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container1">
    <div class="content">
        <div class="container1" id="introduce" style="height: 100vh">
            <h2 class="title animated bounceInLeft">{{ trans('messages.404.msg') }}</h2>
            <div class="text-center" style="padding-bottom: 15px">
                <img src="{{ asset(trans('messages.404.img')) }}">
            </div>
            <p class="text-center">
                <a href="{{ url() }}" class="btn btn-warning">{{ trans('form.link.back-home') }}</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
