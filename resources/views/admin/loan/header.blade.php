@include('admin.partials.error')

<ul class="nav nav-tabs">
    <li @if(Request::is('*'.$module.'s')) class="active" @endif><a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/'.$module.'s') }}" @else href="{{ url('admin/'.$module.'s') }}" @endif><i class="fa fa-align-right"></i> <span>Manage</span></a></li>
    @if(Auth::user()->hasRole('customer'))
        <li @if(Request::is('*apply')) class="active" @endif><a href="{{  url('customer/'.$module.'/apply')  }}"><i class="fa fa-plus"></i> <span>Apply</span></a></li>
    @endif
</ul>
