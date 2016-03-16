@extends('admin.layouts.page')
@section('css')
    <style>.form-forgot .form-group .fa{line-height: 35px; right: 15px}</style>
@stop
@section('content')
    <div class="block-center mt-xl wd-xl">
        <!-- START panel-->
        <div class="panel panel-dark panel-flat">
            <div class="panel-heading text-center">
                <a href="#">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Image" class="block-center img-rounded">
                </a>
            </div>
            <div class="panel-body">
                <p class="text-center pv">{{ trans('admin/title.forgot-password.header') }}</p>
                <form method="post" action="{{ route('admin.accounts.post-forgot-password') }}"
                      data-parsley-validate novalidate class="form-horizontal form-forgot" role="form">
                    @if(!(empty($alert)))
                        <div class="form-group has-feedback">
                            <div class="col-sm-12">
                                <div role="alert" class="alert {{ $alert }} alert-dismissible fade in">
                                    <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <p> {!! session('message') !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                        <p class="text-center">{{ trans('admin/title.forgot-password.msg') }}</p>

                        <div class="form-group has-feedback {{ formAlertError('email') }}">
                            <div class="col-sm-12">
                                <label for="ip-email" class="text-muted">{{ trans('form.users.email') }}</label>
                                <input id="ip-email" name="email" type="email" autocomplete="off" class="form-control" required>
                                <span class="fa fa-envelope form-control-feedback text-muted"></span>
                                {!! formAlertError('email') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="clearfix">
                                    <div class="pull-right"><a href="{{ route('admin.login') }}" class="text-muted">{{ trans('form.link.login') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="col-sm-12">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-block">
                                    {{ trans('form.btn.forgot_password') }}
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <!-- END panel-->
    </div>
@stop