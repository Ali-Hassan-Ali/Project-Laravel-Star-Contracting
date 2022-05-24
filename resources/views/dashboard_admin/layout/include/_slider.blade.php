<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->guard('admin')->user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->guard('admin')->user()->name }}</p>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

            @if (auth()->guard('admin')->user()->hasPermission('dashboard_read'))
                <li class="{{ request()->segment(3) == '' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.admin.welcome') }}"><i class="fa fa-dashboard"></i><span>@lang('dashboard.dashboard')</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->hasPermission('admins_read'))
                <li class="{{ request()->segment(3) == 'admins' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.admin.admins.index') }}"><i class="fa fa-users-cog"></i><span>@lang('admin.admins')</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->hasPermission('vehicles_read'))
                <li class="{{ request()->segment(3) == 'vehicles' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.admin.vehicles.index') }}"><i class="fa fa-car"></i><span>@lang('dashboard.vehicles')</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->hasPermission('orders_read'))
                <li class="{{ request()->segment(3) == 'orders' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.admin.orders.index') }}"><i class="fa fa-archive"></i><span>@lang('dashboard.orders')</span></a>
                </li>
            @endif

            @if (auth()->guard('admin')->user()->hasPermission('citys_read'))
                <li class="{{ request()->segment(3) == 'citys' ? 'active' : '' }}">
                    <a href="{{ route('dashboard.admin.citys.index') }}"><i class="fa fa-city"></i><span>@lang('dashboard.citys')</span></a>
                </li>
            @endif

        </ul>

    </section>

</aside>