<aside class="sidebar">
    <ul class="sidebar-menu">
        <li>
            <a href="/admin">
                <i class="fa fa-bar-chart"></i>
                <span>{{ trans('adminPack::admin.home') }}</span>
            </a>
        </li>
        <li>
            <a href="/admin/manager">
                <i class="fa fa-users"></i>
                <span>{{ trans('adminPack::admin.admin') }}</span>
            </a>
        </li>
        @foreach($sideMenu as $li)
            <li>
                <a href="/admin/{{ $li }}">
                    <i class="fa fa-list"></i>
                    <span>{{ ucfirst($li) }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</aside>