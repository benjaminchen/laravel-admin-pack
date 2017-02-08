@extends('adminPack::layout.default', ['contentTitle' => ucfirst($model)])

@section('content-action', 'Edit')

@section('content')

    @include('adminPack::components.error')
    @include('adminPack::components.message')

    <div class="btn-group pull-right" style="margin-right: 10px">
        <a class="btn btn-sm btn-default" href="/admin/{{ $model }}"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('adminPack::admin.back') }}</a>
    </div>

    <form action="/admin/{{ $model }}/{{ $key }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put" />
        @foreach(BHelper::arraySafeGet($columns, 'file', []) as $column => $attributes)
            <div class="form-group">
                <label class="control-label">{{ ucfirst($column) }}</label>
                <input id="{{ $column }}" type="file" name="{{ $column }}" class="file">
            </div>
        @endforeach
        @foreach(BHelper::arraySafeGet($columns, 'input', []) as $column => $attributes)
            <div class="form-group">
                <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                <input type="{{ BHelper::arraySafeGet($attributes, 'type', 'text') }}" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $data->$column }}">
            </div>
        @endforeach
        @foreach(BHelper::arraySafeGet($columns, 'select', []) as $column => $attributes)
            <div class="form-group">
                <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                <select class="form-control" id="{{ $column }}" name="{{ $column }}">
                    @foreach(BHelper::arraySafeGet($attributes, 'option', []) as $key => $val)
                        <option value="{{ $val }}" @if($data->$column == $val) selected @endif>{{ $key }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
        @foreach(BHelper::arraySafeGet($columns, 'textarea', []) as $column => $attributes)
            <div class="form-group">
                <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                <textarea class="form-control editor" id="{{ $column }}" name="{{ $column }}" rows="{{ BHelper::arraySafeGet($attributes, 'rows', 3) }}">{{ $data->$column }}</textarea>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">{{ trans('adminPack::admin.submit') }}</button>
    </form>
    
@endsection

@section('js')
    @foreach(BHelper::arraySafeGet($columns, 'file', []) as $column => $attributes)
        $("#{{ $column }}").fileinput({
            initialPreview: [
                "{{ asset("upload/{$model}/".$data->$column) }}",
            ],
            initialPreviewAsData: true,
            @if ($type = BHelper::arraySafeGet($attributes, 'type'))
            initialPreviewConfig: [
                {type: "{{ $type }}", url: "{{ asset("upload/{$model}/".$data->$column) }}"},
            ],
            @endif
        });
    @endforeach

    @foreach(BHelper::arraySafeGet($columns, 'textarea', []) as $column => $attributes)
        $("#{{ $column }}").summernote({
            height: 200,
        });
    @endforeach
@endsection