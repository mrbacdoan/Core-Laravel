@extends('backend.layouts.page')
@section('css')
    <style>.fr-login .form-group .fa{line-height: 35px} .forgot-password{float: right; padding: 10px 0;}</style>
@stop
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>IZee </b> Media</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?php
            $alert = getNotification();
            ?>
            @if(!empty($alert) && $alert['type'] != 'success')
                <div class="parsley-required"><center>Đăng nhập không thành công</center></div>
            @endif
            <form action="{{ route('admin.authenticate') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input class="form-control" placeholder="Username or Email" name="email_or_username">
                    {!!  formAlertError('email_or_username') !!}
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    {!!  formAlertError('password') !!}
                </div>
                <div class="forgot-password"><a href="#">I forgot my password</a><br></div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop