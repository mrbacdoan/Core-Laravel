@extends('backend.layouts.master')
@section('content')
    <div class="col-xs-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">{{ trans('backend/title.users.index') }}</h3>
                <div class="row tools">
                    {!! Form::open(['class' => 'form-inline', 'method' => 'GET']) !!}
                    <div class="col-md-7">
                        {!! Form::select('group', [
                           '' => trans('backend/title.filter_group'),
                           GROUP_ADMIN => trans('backend/title.group_admin'),
                           GROUP_USER => trans('backend/title.group_user')], e(Input::get('group')) , ['class' => 'form-control']
                        ) !!}
                    </div>
                    <div class="col-md-5 search text-right">
                        <div class="input-group">
                            {!! Form::text('search', e(Input::get('search')), array('class' => 'form-control col-md-4', 'placeholder' =>  trans('backend/title.input_keyword'))) !!}
                            <span class="input-group-btn">
                            <button id="btnSearch" type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="{{ route('backend.users.index') }}" class="btn btn-default btn-flat"
                               data-toggle="tooltip" data-placement="top"
                               title="{{ trans('backend/title.cancel_search') }}">
                                <i class="fa fa-times-circle"></i>
                            </a>
                        </span>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover thead-center table-bordered users-table">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('backend/table.users.avatar') }}</th>
                        <th class="text-center">{{ trans('backend/table.users.username') }}</th>
                        <th class="text-center">{{ trans('backend/table.users.email') }}</th>
                        <th class="text-center">{{ trans('backend/table.users.full_name') }}</th>
                        <th class="text-center">{{ trans('backend/table.users.group_name') }}</th>
                        <th class="text-center">{{ trans('backend/table.users.created_at') }}</th>
                        <th width="100"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($users) > 0)
                        @foreach($users as $item)
                            <tr>
                                <td class="text-center"><img src="{{ empty($item->avatar) ? url(USER_AVATAR_DEFAULT) : url($item->avatar)}}" class="avatar-table"></td>
                                <td class="text-center">{{ $item->username }}</td>
                                <td class="text-center">{{ $item->email }}</td>
                                <td class="text-center">{{ $item->full_name }}</td>
                                <td class="text-center">{{ $item->group_name }}</td>
                                <td class="text-center">{{ $item->created_at }}</td>
                                <td class="text-center">
                                    {!!  Auth::getUser()->id == $item->id ? '' : btnEdit('backend.users.edit', $item->id) !!}
                                    {!!  Auth::getUser()->id == $item->id ? '' : btnDelete('backend.users.delete', $item->id) !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">{{trans('backend/title.no_data')}}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="row pagination-wrap">
                    <div class="col-md-12 text-right">
                        {!! $users->appends(['search' => e(Input::get('search')), 'group' => e(Input::get('group'))])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.model.delete')
@stop