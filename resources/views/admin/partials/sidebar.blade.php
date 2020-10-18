<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                @if($users->image)
                    <img src="{{ asset('storage/users/'.$users->image) }}" class="img-circle" alt="{{ $option->name }}">
                @else
                    <img src="{{ asset('admin/img/user.png') }}" class="img-circle" alt="{{ $option->name }}">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ str_limit(Auth::user()->name, 14) }}</p>
                <a href="#"><i class="fa fa-circle text-success" style="color: #4cd137;"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">

            @can('manage dashboard')
                <li class="{{ (Request::is('*dashboard') ? 'active' : '') }}">
                    <a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }}" @else href="{{ url('admin/dashboard') }}" @endif><i class='fa fa-dashboard'></i><span> Dashboard </span></a>
                </li>
            @endcan

            @can('manage profile', 'manage option')
                <li class="header uppercase">ACCOUNT SECTION</li>
                @can('manage profile')
                    <li class="{{ (Request::is('*profile*') ? 'active' : '') }}">
                        <a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/user/profile') }}" @else href="{{ url('admin/user/profile') }}" @endif><i class='fa fa-user'></i><span> Profile </span></a>
                    </li>
                @endcan
                @can('manage option')
                    <li class="{{ (Request::is('*options*') ? 'active' : '') }}">
                        <a href="{{ url('admin/options') }}"><i class='fa fa-cog'></i><span> Option </span></a>
                    </li>
                @endcan
            @endcan

            @can('manage loans')
                <li class="header uppercase">LOAN SECTION</li>
                @can('manage loans')
                    <li class="{{  (Request::is('*loan*') ? 'active' : '')  }}">
                        <a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/loans') }}" @else href="{{ url('admin/loans') }}" @endif><i class='fa fa-file-text'></i><span> Loan </span></a>
                    </li>
                @endcan
            @endcan
        </ul>
    </section>
</aside>
