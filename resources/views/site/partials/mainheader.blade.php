<header id="header" class="header">
    <div class="middle-bar">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-12">
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            @if($option->logo)
                                <img src="{{ asset('storage/options/'.$option->logo) }}" alt="{{ $option->name }}">
                            @else
                                <h4><span>{{ str_limit($option->name, 10) }}</span> {{  str_limit($option->name, 10) }}</h4>
                            @endif
                        </a>
                    </div>
                    <div class="link">
                        <a href="{{ url('/') }}">
                            @if($option->logo)
                                <img src="{{ asset('storage/options/'.$option->logo) }}" alt="{{ $option->name }}">
                            @else
                                <h4><span>{{ str_limit($option->name, 10) }}</span> {{ str_limit($option->name, 10) }}</h4>
                            @endif
                        </a>
                    </div>
                    <button class="mobile-arrow"><i class="fa fa-bars"></i></button>
                    <div class="mobile-menu"></div>
                </div>
                <div class="col-lg-10 col-12">
                    <div class="mainmenu">
                        <nav class="navigation">
                            <ul class="nav menu">
                                <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="{{ url('/') }}">Home</a></li>
                                @if(Auth::user())
                                    <li><a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }}" @else href="{{ url('admin/dashboard') }}" @endif>Dashboard</a></li>
                                    <li><a href="{{ url('logout') }}">logout</a></li>
                                @else
                                    <li class="{{ (Request::is('login') ? 'active' : '') }}"><a href="{{ url('login') }}">Login</a></li>
                                @endif
                            </ul>
                        </nav>
                        <div class="button">
                            <a href="#" class="btn">Get a quote</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
