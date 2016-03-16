@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-5">
                    {!! showPaginationFilter('admin.users.admin', $perPage, $parameters) !!}
                </div>
                <div class="col-md-7">
                    <form action="">
                        <input type="hidden" name="per_page" value="{{ $perPage }}">
                        <div class="input-group">
                            <input type="text" name="s" placeholder="{{ trans('form.placeholder.search') }}" class="input-sm form-control" value="{{ $s }}">
                           <span class="input-group-btn">
                              <button type="submit" class="btn btn-sm btn-default">{{ trans('form.btn.search') }}</button>
                           </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-center">{!! showSortBy('#', 'admin.users.admin', 'id', $parameters) !!}</th>
                    <th>{{ trans('admin/table.users.avatar') }}</th>
                    <th>{!! showSortBy(trans('admin/table.users.username'), 'admin.users.admin', 'username', $parameters) !!}</th>
                    <th>{!! showSortBy(trans('admin/table.users.full_name'), 'admin.users.admin', 'first_name', $parameters) !!}</th>
                    <th>{!! showSortBy(trans('admin/table.users.email'), 'admin.users.admin', 'email', $parameters) !!}</th>
                    <th>{!! showSortBy(trans('admin/table.users.phone'), 'admin.users.admin', 'phone', $parameters) !!}</th>
                    <th>{!! showSortBy(trans('admin/table.users.group_name'), 'admin.users.admin', 'group_name', $parameters) !!}</th>
                    <th>{!! showSortBy(trans('admin/table.users.status'), 'admin.users.admin', 'status', $parameters) !!}</th>
                    <th class="col-action">{{ trans('admin/table.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                <tr>
                    <td class="text-center">{{ $row++ }}</td>
                    <td>
                        <div class="media">
                            <img src="{{ autoAddBaseURL($item->avatar) }}" alt="Avatar" class="img-responsive img-circle">
                        </div>
                    </td>
                    <td>{{ $item->username }}</td>
                    <td>{{ displayName($item) }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->group_name }}</td>
                    <td>{!! userStatus($item->status) !!}</td>
                    <td class="col-action">
                        {!!  $_id == $item->id ? '' : btnEdit('admin.users.edit', $item->id) !!}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="row">
                @if($users->count())
                <div class="col-md-6">
                    {{ trans('pagination.label', ['count' => $users->count(), 'from' => $from, 'to' => $from + $users->count() - 1, 'total' => $users->total()]) }}
                </div>
                <div class="col-md-6 text-right">
                    {!! $users->appends($parameters)->render() !!}
                </div>
                @elseif($users->total())
                    <div class="col-md-6">
                        {{ trans('pagination.no_record') }}
                    </div>
                    <div class="col-md-6 text-right">
                        {!! $users->appends($parameters)->render() !!}
                    </div>
                @else
                    <div class="col-md-12">
                        {{ trans('pagination.no_record') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- END panel-->
@stop


