<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <title>{{ config('admin.title') }}</title>
        <link rel="stylesheet" href="{{ asset('vendor/adminPack/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link href="{{ asset('vendor/adminPack/css/admin-pack.min.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        @include('adminPack::components.error')
        <div class="login-box">
            <h3>{{ trans('adminPack::admin.admin_login') }}</h3>
            <form action="{{ URL::to("admin/login") }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback 1">
                    <input type="input" class="form-control" placeholder="{{ trans('adminPack::admin.username') }}" name="username" value="{{ old('username') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback 1">
                    <input type="password" class="form-control" placeholder="{{ trans('adminPack::admin.password') }}" name="password" value="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-4 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminPack::admin.login') }}</button>
                    </div>
                </div>
            </form>
        </div>
        
        <script src="{{ asset('vendor/adminPack/js/admin-pack.min.js') }}"></script>
    </body>
</html>