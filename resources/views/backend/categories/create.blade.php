@extends('backend.layouts.master')

@section('content')
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">{{ trans('backend/title.categories.create') }}</h3>
            </div>
            {!! Form::open(array('route' => 'backend.categories.store', 'method' => 'POST', 'class' => 'form-horizontal'))  !!}
                <div class="box-body">
                    <div class="form-group {{formHasError('name')}}">
                        <label class="col-sm-2 control-label">{{ trans('backend/table.categories.name') }}</label>
                        <div class="col-sm-9">
                            {!! Form::text('name', null, array('class' => 'form-control')) !!}
                            {!!  formAlertError('name') !!}
                        </div>
                    </div>
                    <div class="form-group {{formHasError('slug')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.categories.slug')}}</label>
                        <div class="col-sm-9">
                            {!! Form::text('slug', null, array('class' => 'form-control')) !!}
                            {!!  formAlertError('slug') !!}
                        </div>
                    </div>
                    @if(!empty($categories))
                    <div class="form-group {{formHasError('parent_id')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.users.group_name')}}</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="parent_id">
                                <option value="0">--- root ---</option>
                                {!! recursionSelected($categories, $parent = 0, $txt = '') !!}
                            </select>
                            {!!  formAlertError('parent_id') !!}
                        </div>
                    </div>
                    @endif
                    <div class="form-group {{formHasError('priority')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.categories.priority')}}</label>
                        <div class="col-sm-9">
                            {!! Form::text('priority', null, array('class' => 'form-control')) !!}
                            {!!  formAlertError('priority') !!}
                        </div>
                    </div>
                    <div class="form-group {{formHasError('status')}}">
                        <label class="col-sm-2 control-label">{{trans('backend/table.categories.status')}}</label>
                        <div class="col-sm-9">
                            <label>{!! Form::radio('status', STATUS_ACTIVATED, true)!!}{{trans('backend/title.active') }}</label>
                            <label>{!! Form::radio('status', STATUS_DEACTIVATED, false)!!}{{trans('backend/title.deactive') }}</label>
                        </div>
                        {!!  formAlertError('status') !!}
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">{{trans('form.btn.create')}}</button>
                            <button type="reset" class="btn btn-danger">{{trans('form.btn.reset')}}</button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop