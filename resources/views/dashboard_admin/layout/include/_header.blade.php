<header class="main-header">

    {{--<!-- Logo -->--}}
    <a href="{{ asset('dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>-A</span>
        <span class="logo-lg"><b>mobasher-app</b></span>
    </a>

    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
             

                {{-- User Account: style can be found in dropdown.less --}}
                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ auth()->guard('admin')->user()->image_path }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->guard('admin')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu" style="margin-top: 13px;">

                        {{-- !User image  --}}
                        <li class="user-header">
                            <img src="{{ auth()->guard('admin')->user()->image_path }}" class="img-circle" alt="User Image">

                            <p>
                                {{ auth()->guard('admin')->user()->name }}
                                {{-- <small>Member since 2 days</small> --}}
                            </p>
                        </li>

                         {{-- Menu Footer --}}
                        <li class="user-footer">
                            
                            <a href="{{ route('dashboard.logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">@lang('dashboard.logout')</a>

                            <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            <a href="/" class="btn btn-default btn-flat">@lang('dashboard.dashboard')</a>
                            {{-- <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-default btn-flat">@lang('home.profile')</a> --}}

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

</header>