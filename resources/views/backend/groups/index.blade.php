@extends('backend.layouts.master')

@section('content')
    <div class="col-xs-12">
        <div class="box box-danger">
            <div class="box-header">
                <div class="row tools">
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-5 search text-right">
                        {!! Form::open(['class' => 'form-inline', 'method' => 'GET']) !!}
                        <div class="input-group">
                            {!! Form::text('term', e(Input::get('term')), array('class' => 'form-control col-md-4', 'placeholder' =>  trans('backend/title.input_keyword'))) !!}
                            <span class="input-group-btn">
                            <button id="btnSearch" type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                            <a href="{{ route('backend.users.index') }}" class="btn btn-default btn-flat"
                               data-toggle="tooltip" data-placement="top"
                               title="{{getLang('title.cancel_search')}}">
                                <i class="fa fa-times-circle"></i>
                            </a>
                        </span>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover thead-center table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Tên nhóm</th>
                            <th class="text-center">Số người</th>
                            <th class="text-center">Ngày tạo</th>
                            <th width="100" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($groups) > 0)
                        @foreach($groups as $item)
                            <tr class="text-center">
                                <td >{{$item->name}}</td>
                                <td>{{$item->users}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{!! btnEdit('backend.groups.edit', $item->id)!!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">{{ trans('backend/title.no_data') }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="row pagination-wrap">
                    <div class="col-md-4 label-pagination">
                    </div>
                    <div class="col-md-8 text-right">
                    {!! $groups->appends(['search' => e(Input::get('search'))])->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop