@extends('backend.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="post" action="{{ route('backend.groups.update', $group['id']) }}" class="form-horizontal form-group" data-parsley-validate novalidate>
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group {{ formHasError('name') }}">
                    <label class="col-sm-2 control-label" for="in-name">{{ trans('form.groups.name') }}</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="in-name" required maxlength="255" value="{{ old('name', $group['name']) }}" class="form-control">
                        {!! formAlertError('name') !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="in-name">{{ trans('form.groups.permission') }}</label>
                    <div class="col-sm-10">
                        <?php
                        $allow = trans('permissions._global.allow');
                        $deny = trans('permissions._global.deny');
                        ?>
                        @foreach($permissions as $key => $val)
                            <h4 class="title">{{ trans('permissions.' . $key . '.title') }}</h4>
                            <div class="row">
                                @foreach($val['permissions'] as $k =>$item)
                                    <div class="col-sm-2">
                                        <strong class="p-name">{{ $item }}</strong>
                                        <label class="radio c-radio allow" for="{{ $key . $k }}-allow">
                                            <input type="radio" id="{{ $key . $k }}-allow" name="permissions[{{ $k }}]" value="1" {{ in_array($k, $group['permissions']) ? 'checked' : '' }}>
                                            <span class="fa fa-check"></span>{{ $allow }}
                                        </label>
                                        <label class="radio c-radio deny" for="{{ $key . $k }}-deny">
                                            <input type="radio" id="{{ $key . $k }}-deny" name="permissions[{{ $k }}]" value="0" {{ !in_array($k, $group['permissions']) ? 'checked' : ''}}>
                                            <span class="fa fa-times"></span>{{ $deny }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
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