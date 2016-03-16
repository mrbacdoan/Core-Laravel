@extends('backend.layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">{{ trans('backend/title.users.edit', ['username' => $user->username]) }}</h3>
            </div>
            {!! Form::model($user, array('route' => array('backend.users.update', $user->id), 'method' => 'PUT', 'class' => 'form-horizontal'))  !!}
                <div class="box-body">
                    <div class="form-group {{formHasError('username')}}">
                        <label class="col-sm-2 control-label">{{ trans('backend/table.users.username') }}</label>
                        <div class="col-sm-9">
                            {!! Form::text('username', null, array('class' => 'form-control')) !!}
                            {!!  formAlertError('username') !!}
                        </div>
                    </div>
                    <div class="form-group {{formHasError('full_name')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.users.full_name')}}</label>
                        <div class="col-sm-9">
                            {!! Form::text('full_name', null, array('class' => 'form-control')) !!}
                            {!!  formAlertError('full_name') !!}
                        </div>
                    </div>
                    <div class="form-group {{formHasError('password')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.users.password')}}</label>
                        <div class="col-sm-9">
                            {!! Form::password('password', array('class' => 'form-control')) !!}
                            {!!  formAlertError('password') !!}
                        </div>
                    </div>
                    <div class="form-group {{formHasError('re_password')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.users.re_password')}}</label>
                        <div class="col-sm-9">
                            {!! Form::password('re_password', array('class' => 'form-control')) !!}
                            {!!  formAlertError('re_password') !!}
                        </div>
                    </div>
                    <div class="form-group {{formHasError('email')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.users.email')}}</label>
                        <div class="col-sm-9">
                            {!! Form::text('email', null, array('class' => 'form-control')) !!}
                            {!!  formAlertError('email') !!}
                        </div>
                    </div>
                    <div class="form-group {{formHasError('phone')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.users.phone')}}</label>
                        <div class="col-sm-9">
                            {!! Form::text('phone', null, array('class' => 'form-control')) !!}
                            {!!  formAlertError('phone') !!}
                        </div>
                    </div>
                    @if(!empty($groups))
                    <div class="form-group {{formHasError('group_id')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.users.group_name')}}</label>
                        <div class="col-sm-9">
                            {!! Form::select('group_id', $groups, null, array('class' => 'form-control')) !!}
                            {!!  formAlertError('group_id') !!}
                        </div>
                    </div>
                    @endif
                    <div class="form-group {{formHasError('gender')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.users.gender')}}</label>
                        <div class="col-sm-9">
                            <label>{!! Form::radio('gender', SEX_MALE, ($user->gender == SEX_MALE) ? true : false)!!}{{trans('backend/table.users.male') }}</label>
                            <label>{!! Form::radio('gender', SEX_FEMALE, ($user->gender == SEX_FEMALE) ? true : false)!!}{{trans('backend/table.users.female') }}</label>
                        </div>
                        {!!  formAlertError('gender') !!}
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{ trans('backend/table.users.birthday')}}</label>
                        <div class="col-sm-9">
                            {!! Form::text('birthday', null, array('class' => 'form-control datetimepicker', 'data-date-format="yyyy/mm/dd"')) !!}
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">{{trans('form.btn.edit')}}</button>
                            <button type="reset" class="btn btn-danger">{{trans('form.btn.reset')}}</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop