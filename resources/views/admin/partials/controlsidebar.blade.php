<aside class="control-sidebar control-sidebar-dark">
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Website Options</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href="{{ url('/') }}" target="_blank">
                        <i class="menu-icon fa fa-globe bg-green"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Visit Site</h4>
                            <p>{{ str_limit(url('/'), 25) }}</p>
                        </div>
                    </a>
                </li>

                @role('admin')
                <li>
                    <a href="{{ url('admin/options') }}">
                        <i class="menu-icon fa fa-gear bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Option</h4>
                            <p>Last update: {{ $option->updated_at->format('d M Y') }}</p>
                        </div>
                    </a>
                </li>
                @endrole

                @role('admin')
                <li>
                    <a href="{{ url('admin/cache/flush') }}">
                        <i class="menu-icon fa fa-refresh bg-orange"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Clear Cache</h4>
                            <p>Flush all cache data</p>
                        </div>
                    </a>
                </li>
                @endrole
            </ul>
        </div>
    </div>
</aside>
<div class='control-sidebar-bg'></div>
