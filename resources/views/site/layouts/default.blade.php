<!DOCTYPE html>
<html lang="en">
@section('htmlheader')
    <head>
        @include('site.partials.htmlheader')
    </head>
@show
<body>
    <div class="preloader">
        <div class="preloader-inner">
          <div class="single-loader one"></div>
          <div class="single-loader two"></div>
          <div class="single-loader three"></div>
          <div class="single-loader four"></div>
          <div class="single-loader five"></div>
          <div class="single-loader six"></div>
          <div class="single-loader seven"></div>
          <div class="single-loader eight"></div>
          <div class="single-loader nine"></div>
        </div>
    </div>
    <div id="genit-page">
		<div class="container-wrap">
            @include('site.partials.mainheader')
            @yield('main-content')
            @include('site.partials.footer')
        </div>
    </div>
    @section('scripts')
    @include('site.partials.scripts')
    @show
</body>
</html>
