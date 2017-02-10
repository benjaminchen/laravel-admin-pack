<div class="row">
    <div class="col-lg-2 col-md-2 logo">
        <a href="{{ URL::to("admin") }}">
            <span><b>{{ trans('adminPack::admin.my_admin') }}</b></span>
        </a>
    </div>
    <div class="col-lg-10 col-md-10 nav">
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="javascript:void(0);" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <ul class="noselect user-box">
                <i class="fa fa-address-book"></i>
                <?php $currentUser = Auth::guard('admin')->user(); ?>
                <span>{{ $currentUser->name }}</span>
                <div class="header-option">
                    <div class="pull-left">
                        <a href="{{ URL::to("admin/manager/".$currentUser->id."/edit") }}" class="btn btn-default btn-flat">{{ trans('adminPack::admin.setting') }}</a>
                    </div>
                    <div class="pull-right">
                        <a href="{{ URL::to("admin/logout") }}" class="btn btn-default btn-flat">{{ trans('adminPack::admin.logout') }}</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>