<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <title>{{ config('admin.title') }}</title>
        <link rel="stylesheet" href="{{ asset('vendor/adminPack/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link href="{{ asset('vendor/adminPack/css/admin-pack.min.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header class="main-header">
            <div class="container-fluid">
                @include('adminPack::components.header')
            </div>
        </header>
        <div id="wrapper" class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2 sidebar-container">
                    @include('adminPack::components.sidebar')
                </div>
                <div class="col-lg-10 col-md-10 content">
                    <section class="content-header">
                        <h1>
                            {{ $contentTitle or '' }}
                            <small>@yield('content-action')</small>
                        </h1>
                    </section>
                    @yield('content')
                </div>
            </div>
        </div>
        <footer>
            <div class="container-fluid">
                @include('adminPack::components.footer')
            </div>
        </footer>
        
        <script src="{{ asset('vendor/adminPack/js/admin-pack.min.js') }}"></script>
        <script>
            @yield('js')
        </script>
    </body>
</html>