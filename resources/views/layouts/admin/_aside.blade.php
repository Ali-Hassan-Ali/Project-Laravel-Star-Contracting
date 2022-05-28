<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{ auth()->user()->image_path }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->roles->first()->name }}</p>
        </div>
    </div>

    <ul class="app-menu">

        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('admin.home') }}"><i class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">@lang('site.home')</span></a></li>

        {{--roles--}}
        @if (auth()->user()->hasPermission('read_roles'))
            <li><a class="app-menu__item {{ request()->is('*roles*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}"><i class="app-menu__icon fa fa-lock"></i> <span class="app-menu__label">@lang('roles.roles')</span></a></li>
        @endif

        {{--admins--}}
        @if (auth()->user()->hasPermission('read_admins'))
            <li><a class="app-menu__item {{ request()->is('*admins*') ? 'active' : '' }}" href="{{ route('admin.admins.index') }}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">@lang('admins.admins')</span></a></li>
        @endif

        {{--countrys--}}
        @if (auth()->user()->hasPermission('read_countrys'))
            <li><a class="app-menu__item {{ request()->is('*countrys*') ? 'active' : '' }}" href="{{ route('admin.countrys.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">@lang('countrys.countrys')</span></a></li>
        @endif

        {{--countrys--}}
        @if (auth()->user()->hasPermission('read_citys'))
            <li><a class="app-menu__item {{ request()->is('*citys*') ? 'active' : '' }}" href="{{ route('admin.citys.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">@lang('citys.citys')</span></a></li>
        @endif

        {{--countrys--}}
        @if (auth()->user()->hasPermission('read_types'))
            <li><a class="app-menu__item {{ request()->is('*types*') ? 'active' : '' }}" href="{{ route('admin.types.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">@lang('types.types')</span></a></li>
        @endif


        {{--statuses--}}
        @if (auth()->user()->hasPermission('read_status'))
            <li><a class="app-menu__item {{ request()->is('*status*') ? 'active' : '' }}" href="{{ route('admin.status.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">@lang('status.status')</span></a></li>
        @endif

        {{--equipments--}}
        @if (auth()->user()->hasPermission('read_equipments'))
            <li><a class="app-menu__item {{ request()->is('*equipments*') ? 'active' : '' }}" href="{{ route('admin.equipments.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">@lang('equipments.equipments')</span></a></li>
        @endif


        {{--settings--}}
        @if (auth()->user()->hasPermission('read_settings'))
            <li class="treeview {{ request()->is('*settings*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">@lang('settings.settings')</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="{{ route('admin.settings.general') }}"><i class="icon fa fa-circle-o"></i>@lang('settings.general')</a></li>
                </ul>
            </li>
        @endif

        {{--profile--}}
        <li class="treeview {{ request()->is('*profile*') || request()->is('*password*')  ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">@lang('users.profile')</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{ route('admin.profile.edit') }}"><i class="icon fa fa-circle-o"></i>@lang('users.edit_profile')</a></li>
                <li><a class="treeview-item" href="{{ route('admin.profile.password.edit') }}"><i class="icon fa fa-circle-o"></i>@lang('users.change_password')</a></li>
            </ul>
        </li>

    </ul>
</aside>
