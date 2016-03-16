@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="post" action="{{ route('admin.accounts.put-change-password') }}" class="form-horizontal form-user" data-parsley-validate novalidate>
                <input name="_method" type="hidden" value="PUT">
                @if(!(empty($alert)))
                <div class="form-group has-feedback">
                    <div class="col-sm-9 col-sm-offset-2">
                        <div role="alert" class="alert {{ $alert }} alert-dismissible fade in">
                            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <p> {!! session('message') !!}</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="in-username">{{ trans('form.users.username') }}</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" id="in-username" disabled value="{{ $user->username }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="in-email">{{ trans('form.users.email') }}</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" id="in-email" disabled value="{{ $user->email }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="in-old_password">{{ trans('form.users.old_password') }}</label>
                    <div class="col-sm-10">
                        <input type="password" name="old_password" id="in-old_password" class="form-control" placeholder="{{ trans('form.users.old_password') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{ trans('form.users.new_password') }}</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-6 {{ formHasError('password') }}">
                                <input placeholder="{{ trans('form.users.new_password') }}" value="{{ old('new_password') }}" class="form-control" id="ip-password" name="new_password" minlength="6" type="password" required>
                                {!! formAlertError('new_password') !!}
                            </div>
                            <div class="col-sm-6 {{ formHasError('password_confirmation') }}">
                                <input placeholder="{{ trans('form.users.password_confirmation') }}" value="{{ old('password_confirmation') }}" data-parsley-equalto="#ip-password" class="form-control" name="password_confirmation" type="password" required>
                                {!! formAlertError('password_confirmation') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <fieldset>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">{{ trans('form.btn.update') }}</button>
                            <button type="reset" class="btn btn-default">{{ trans('form.btn.cancel') }}</button>
                            {{ csrf_field() }}
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@stop