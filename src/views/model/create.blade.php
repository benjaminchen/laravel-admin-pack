@extends('adminPack::layout.default', ['contentTitle' => ucfirst($model)])

@section('content-action', 'Create')

@section('content')

    @include('adminPack::components.error')

    <div class="btn-group pull-right" style="margin-right: 10px">
        <a class="btn btn-sm btn-default" href="/admin/{{ $model }}"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('adminPack::admin.back') }}</a>
    </div>

    <form action="/admin/{{ $model }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @foreach(BHelper::arraySafeGet($columns, 'file', []) as $column => $attributes)
            <div class="form-group">
                <label class="control-label">{{ ucfirst($column) }}</label>
                <input id="{{ $column }}" type="file" name="{{ $column }}" class="file" data-preview-file-type="text">
            </div>
        @endforeach
        @foreach(BHelper::arraySafeGet($columns, 'input', []) as $column => $attributes)
            <div class="form-group">
                <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                <input type="{{ BHelper::arraySafeGet($attributes, 'type', 'text') }}" class="form-control" id="{{ $column }}" name="{{ $column }}" placeholder="{{ BHelper::arraySafeGet($attributes, 'placeholder', "Input ".ucfirst($column)) }}" value="{{ old($column) }}">
            </div>
        @endforeach
        @foreach(BHelper::arraySafeGet($columns, 'select', []) as $column => $attributes)
            <div class="form-group">
                <label for="{{ $column }}">Example multiple select</label>
                <select class="form-control" id="{{ $column }}" name="{{ $column }}">
                    @foreach(BHelper::arraySafeGet($attributes, 'option', []) as $key => $val)
                        <option value="{{ $val }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        @foreach(BHelper::arraySafeGet($columns, 'textarea', []) as $column => $attributes)
            <div class="form-group">
                <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                <textarea class="form-control" id="{{ $column }}" name="{{ $column }}" rows="{{ BHelper::arraySafeGet($attributes, 'rows', 3) }}"></textarea>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">{{ trans('adminPack::admin.submit') }}</button>
    </form>
@endsection

@section('js')
    @foreach(BHelper::arraySafeGet($columns, 'file', []) as $column => $attributes)
        $("#{{ $column }}").fileinput();
    @endforeach

    @foreach(BHelper::arraySafeGet($columns, 'textarea', []) as $column => $attributes)
        $("#{{ $column }}").summernote({
            height: 200,
        });
    @endforeach
@endsection
