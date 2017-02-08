@extends('adminPack::layout.default', ['contentTitle' => 'Administrator'])

@section('content-action', 'List')

@section('content')

    @include('adminPack::components.error')
    @include('adminPack::components.message')

    <div class="btn-group pull-right" style="margin-right: 10px">
        <a class="btn btn-sm btn-default" href="/admin/manager/create"><i class="fa fa-save"></i>&nbsp;{{ trans('adminPack::admin.new') }}</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('adminPack::admin.username') }}</th>
                <th>{{ trans('adminPack::admin.name') }}</th>
                <th>{{ trans('adminPack::admin.role') }}</th>
                <th>{{ trans('adminPack::admin.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $key => $admin)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->role }}</td>
                <td>
                    <a href="/admin/manager/{{ $admin->getKey() }}/edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" data-key="{{ $admin->getKey() }}" data-token="{{ csrf_token() }}" class="model-row-delete">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection