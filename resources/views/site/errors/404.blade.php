@extends('site.layouts.default')

@section('htmlheader_title')
    Page not found
@endsection

@section('main-content')
	<section class="breadcrumbs">
	    <div class="container">
			<div class="row">
				<div class="col-12">
					<h2>404</h2>
					<ul>
						<li><a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a></li>
						<li class="active"><a href="#"><i class="fa fa-exclamation-circle"></i>404</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
    <div id="genit-main">
        <section class="genit-login" data-section="login" style="padding: 5% 0 10% 0;">
            <div class="genit-narrow-content">
                <h1 class="text-center" style="font-weight: 900; font-size: 110px; margin-bottom: 0;">404</h1>
                <div class="text-center">
                    <h3 style="margin-bottom: 15px; font-weight: 100;">Page Not Found</h3>
                    <p>It seems we can’t find the page you are looking for. <a href="{{ url('/') }}" style="color: #666;">Go back to Homepage</a></p>
                </div>
            </div>
        </section>
    </div>
@endsection
