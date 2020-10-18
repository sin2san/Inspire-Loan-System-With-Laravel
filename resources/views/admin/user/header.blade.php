@include('admin.partials.error')

<ul class="nav nav-tabs">
    <li @if(Request::is('*permission*')) class="active" @endif><a href="{{ url('admin/permissions') }}"><i class="fa fa-align-right"></i> <span>Permission</span></a></li>
    <li @if(Request::is('*role*')) class="active" @endif><a href="{{ url('admin/roles') }}"><i class="fa fa-rotate-left"></i> <span>Roles</span></a></li>
    <li @if(Request::is('*user*')) class="active" @endif><a href="{{ url('admin/users') }}"><i class="fa fa-user-secret"></i> <span>Users</span></a></li>
    @yield('actions')
</ul>
