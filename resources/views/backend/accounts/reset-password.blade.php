@extends('admin.layouts.page')

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
                <form method="post" action="{{ route('admin.accounts.post-reset-password') }}"
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

                    <div class="form-group has-feedback {{ formAlertError('new_password') }}">
                        <div class="col-sm-12">
                            <label for="ip-new_password" class="text-muted">{{ trans('form.users.new_password') }}</label>
                            <input id="ip-new_password" name="new_password" type="password" autocomplete="off" class="form-control" required  minlength="6">
                            {!! formAlertError('new_password') !!}
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ formAlertError('password_confirmation') }}">
                        <div class="col-sm-12">
                            <label for="ip-password_confirmation" class="text-muted">{{ trans('form.users.password_confirmation') }}</label>
                            <input id="ip-password_confirmation" name="password_confirmation" type="password" autocomplete="off" class="form-control" required data-parsley-equalto="#ip-new_password" >
                            {!! formAlertError('password_confirmation') !!}
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
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ trans('form.btn.reset_password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END panel-->
    </div>
@stop