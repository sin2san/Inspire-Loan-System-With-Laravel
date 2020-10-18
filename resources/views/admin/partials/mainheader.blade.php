<header class="main-header">
    <a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }} @else href="{{ url('admin/dashboard') }} @endif" class="logo" title="{{ $option->name }}">
        <span class="logo-mini">@if(Auth::user()->hasRole('customer')) CP @else AP @endif</span>
        <span class="logo-lg">{{ $option->name }}</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if($users->image)
                            <img src="{{ asset('storage/users/'.$users->image) }}" class="user-image" alt="Image">
                        @else
                            <img src="{{ asset('admin/img/user.png') }}" class="user-image" alt="Image">
                        @endif
                        <span class="hidden-xs">{{ str_limit(Auth::user()->name, 20) }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            @if($users->image)
                                <img src="{{ asset('storage/users/'.$users->image) }}" class="img-circle" alt="User">
                            @else
                                <img src="{{ asset('admin/img/user.png') }}" class="img-circle" alt="User">
                            @endif
                            <p>
                                {{ Auth::user()->name }}
                                <small>Since {{ Auth::user()->created_at->format('d M, Y') }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                @if(Auth::user()->hasRole('customer'))
                                    <a href="{{ url('customer/user/profile') }}" class="btn btn-default btn-flat">Profile</a>
                                @else
                                    <a href="{{ url('admin/user/profile') }}" class="btn btn-default btn-flat">Profile</a>
                                @endif
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('logout') }}" class="btn btn-default btn-flat">Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" @if(Auth::user()->hasRole('admin')) data-toggle="control-sidebar" @endif><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
