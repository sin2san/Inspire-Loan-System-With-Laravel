<!DOCTYPE html>
<html lang="en">

@section('htmlheader')
    <head>
        @include('admin.partials.htmlheader')
    </head>
@show

<body class="skin-blue-light sidebar-mini">
    <div class="wrapper">
        @include('admin.partials.mainheader')
        @include('admin.partials.sidebar')
        <div class="content-wrapper">
            @include('admin.partials.contentheader')
            <section class="content">
                @yield('main-content')
            </section>
        </div>
        @if(Auth::user()->hasRole('admin'))
            @include('admin.partials.controlsidebar')
        @endif
        @include('admin.partials.footer')
    </div>
    @section('scripts')
        @include('admin.partials.scripts')
    @show
</body>
</html>
