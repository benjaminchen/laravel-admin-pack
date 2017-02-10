@extends('adminPack::layout.default', ['contentTitle' => 'Administrator'])

@section('content-action', 'Create')

@section('content')

    @include('adminPack::components.error')

    <div class="btn-group pull-right" style="margin-right: 10px">
        <a class="btn btn-sm btn-default" href="{{ URL::to("admin/manager") }}"><i class="fa fa-arrow-left"></i>&nbsp;{{ trans('adminPack::admin.back') }}</a>
    </div>

    <form action="{{ URL::to("admin/manager") }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="username">{{ trans('adminPack::admin.username') }}</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="username" value="{{ old('username') }}">
        </div>

        <div class="form-group">
            <label for="password" class="control-label">{{ trans('adminPack::admin.password') }}</label>
            <div class="form-inline row">
                <div class="form-group col-md-6">
                    <input type="password" data-minlength="6" class="form-control" id="password" name="password" placeholder="Password" required>
                    <div class="help-block">{{ trans('adminPack::admin.minimum_6') }}</div>
                </div>
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" data-match="#password" placeholder="Confirm" required>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="name">{{ trans('adminPack::admin.name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="role">{{ trans('adminPack::admin.role') }}</label>
            <input type="text" class="form-control" id="role" name="role" placeholder="role" value="{{ old('role') }}">
        </div>

        <button type="submit" class="btn btn-primary">{{ trans('adminPack::admin.submit') }}</button>
    </form>
    
@endsection
