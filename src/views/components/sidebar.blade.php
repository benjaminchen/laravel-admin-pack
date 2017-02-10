<aside class="sidebar">
    <ul class="sidebar-menu">
        <li>
            <a href="{{ URL::to("admin") }}">
                <i class="fa fa-bar-chart"></i>
                <span>{{ trans('adminPack::admin.home') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ URL::to("admin/manager") }}">
                <i class="fa fa-users"></i>
                <span>{{ trans('adminPack::admin.admin') }}</span>
            </a>
        </li>
        @foreach($sideMenu as $li)
            <li>
                <a href="{{ URL::to("admin/$li") }}">
                    <i class="fa fa-list"></i>
                    <span>{{ ucfirst($li) }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</aside>