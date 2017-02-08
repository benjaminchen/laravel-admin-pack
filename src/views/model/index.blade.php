@extends('adminPack::layout.default', ['contentTitle' => ucfirst($model)])

@section('content-action', 'List')

@section('content')

    @include('adminPack::components.error')
    @include('adminPack::components.message')

    <div class="btn-group pull-right" style="margin-right: 10px">
        <a class="btn btn-sm btn-default" href="/admin/{{ $model }}/create"><i class="fa fa-save"></i>&nbsp;{{ trans('adminPack::admin.new') }}</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                @foreach($columns as $column)
                <th>{{ $column }}</th>
                @endforeach
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $key => $data)
            <tr>
                <td>{{ $key+1 }}</td>
                @foreach($columns as $column)
                <td>{{ $data->$column }}</td>
                @endforeach
                <td>
                    <a href="/admin/{{ $model }}/{{ $data->getKey() }}/edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" data-key="{{ $data->getKey() }}" data-token="{{ csrf_token() }}" class="model-row-delete">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
