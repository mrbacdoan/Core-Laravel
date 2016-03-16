@extends('backend.layouts.master')

@section('content')
    <div class="col-xs-12">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">{{ trans('backend/title.categories.index') }}</h3>
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
                            <a href="{{ route('backend.categories.index') }}" class="btn btn-default btn-flat"
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
                        <th class="text-center">{{ trans('backend/table.categories.name') }}</th>
                        <th class="text-center">{{ trans('backend/table.categories.slug') }}</th>
                        <th class="text-center">{{ trans('backend/table.categories.status') }}</th>
                        <th class="text-center">{{ trans('backend/table.categories.created_at') }}</th>
                        <th width="100"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($categories) > 0)
                        @foreach($categories as $item)
                            <tr>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->slug }}</td>
                                <td class="text-center">{{ $item->status }}</td>
                                <td class="text-center">{{ $item->created_at }}</td>
                                <td class="text-center">
                                    {!!  btnEdit('backend.categories.edit', $item->id) !!}
                                    {!!  btnDelete('backend.categories.delete', $item->id) !!}
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
                        {!! $categories->appends(['search' => e(Input::get('search'))])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.model.delete')
@stop