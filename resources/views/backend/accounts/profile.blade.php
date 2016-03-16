@extends('backend.layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="col-md-3">
            <div class="box box-danger">
                <div class="box-body box-profile">
                    <div class="box-avatar">
                        <img class="profile-user-img img-responsive img-circle avatar" src="{{ empty($profile->avatar) ? url(USER_AVATAR_DEFAULT) : url($profile->avatar) }}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $profile->full_name }}</h3>
                    <p class="text-muted text-center">{{ $profile->group_name }}</p>
                    <a href="#" class="btn btn-primary btn-block" data-target="#change-avatar" data-toggle="modal"><b>Thay đổi Avatar</b></a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="{{ (!checkTabProfile()) ? 'active' : '' }}"><a href="#settings" data-toggle="tab">Thông tin cá nhân</a></li>
                    <li class="{{ (checkTabProfile()) ? 'active' : '' }}"><a href="#timeline" data-toggle="tab">Đổi mật khẩu</a></li>
                </ul>
                <div class="tab-content">
                    <div class="{{ (!checkTabProfile()) ? 'active' : '' }} tab-pane" id="settings">
                        {!! Form::model($profile, array('route' => array('backend.account.update-profile', $profile->id), 'method' => 'PUT', 'class' => 'form-horizontal'))  !!}
                            <div class="form-group {{ formHasError('full_name') }}">
                                <label for="inputName" class="col-sm-3 control-label">{{trans('backend/table.users.full_name')}}</label>
                                <div class="col-sm-9">
                                    {!! Form::text('full_name', null, array('class' => 'form-control')) !!}
                                    {!!  formAlertError('full_name') !!}
                                </div>
                            </div>
                            <div class="form-group {{formHasError('phone')}}">
                                <label for="inputEmail" class="col-sm-3 control-label">{{trans('backend/table.users.phone')}}</label>
                                <div class="col-sm-9">
                                    {!! Form::text('phone', null, array('class' => 'form-control')) !!}
                                    {!!  formAlertError('phone') !!}
                                </div>
                            </div>
                            <div class="form-group {{formHasError('address')}}">
                                <label for="inputName" class="col-sm-3 control-label">{{trans('backend/table.users.address')}}</label>
                                <div class="col-sm-9">
                                    {!! Form::text('address', null, array('class' => 'form-control')) !!}
                                    {!!  formAlertError('address') !!}
                                </div>
                            </div>
                            <div class="form-group {{formHasError('gender')}}">
                                <label for="inputExperience" class="col-sm-3 control-label">{{trans('backend/table.users.gender')}}</label>
                                <div class="col-sm-9">
                                    <label>{!! Form::radio('gender', SEX_MALE, ($profile->gender == SEX_MALE) ? true : false)!!}{{trans('backend/table.users.male') }}</label>
                                    <label>{!! Form::radio('gender', SEX_FEMALE, ($profile->gender == SEX_FEMALE) ? true : false)!!}{{trans('backend/table.users.female') }}</label>
                                </div>
                                {!!  formAlertError('gender') !!}
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-3 control-label">{{ trans('backend/table.users.birthday')}}</label>
                                <div class="col-sm-9">
                                    {!! Form::text('birthday', null, array('class' => 'form-control datetimepicker', 'data-date-format="yyyy/mm/dd"')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">{{trans('form.btn.edit')}}</button>
                                    <button type="reset" class="btn btn-danger">{{trans('form.btn.reset')}}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane {{ (checkTabProfile()) ? 'active' : '' }}" id="timeline">
                        {!! Form::open(array('route' => 'backend.account.change-password', 'method' => 'PUT', 'class' => 'form-horizontal'))  !!}
                            <div class="form-group {{formHasError('old_password')}}">
                                <label for="inputName" class="col-sm-3 control-label">{{ trans('backend/table.users.old_password')}}</label>
                                <div class="col-sm-9">
                                    {!! Form::password('old_password', array('class' => 'form-control')) !!}
                                    {!!  formAlertError('old_password') !!}
                                </div>
                            </div>
                            <div class="form-group {{formHasError('new_password')}}">
                                <label for="inputEmail" class="col-sm-3 control-label">{{ trans('backend/table.users.new_password') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::password('new_password', array('class' => 'form-control')) !!}
                                    {!!  formAlertError('new_password') !!}
                                </div>
                            </div>
                            <div class="form-group {{formHasError('password_confirmation')}}">
                                <label for="inputName" class="col-sm-3 control-label">{{ trans('backend/table.users.password_confirmation') }}</label>
                                <div class="col-sm-9">
                                    {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                                    {!!  formAlertError('password_confirmation') !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">{{trans('form.btn.edit')}}</button>
                                    <button type="reset" class="btn btn-danger">{{trans('form.btn.reset')}}</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="change-avatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Thay đổi avatar</h4>
                </div>
                <div class="modal-body modal-body-avatar">
                    <div class="imageBox">
                        <div class="thumbBox"></div>
                        <div class="spinner" style="display: none">Loading...</div>
                    </div>
                    <div class="action">
                        <input type="file" id="file" style="float:left; width: 250px" class="btn btn-default">
                        <button type="button" id="btnCrop" style="float: right" class="btn btn-success"> Save </button>
                        <button type="button" id="btnZoomIn" style="float: right" class="btn btn-primary"> + </button>
                        <button type="button" id="btnZoomOut" style="float: right" class="btn btn-primary"> - </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop



