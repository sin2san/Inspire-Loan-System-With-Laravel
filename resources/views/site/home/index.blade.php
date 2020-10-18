@extends('site.layouts.default')

@section('htmlheader_title')
    Home
@endsection

@section('main-content')
    <div id="genit-main">
		<section id="hero-area" class="hero-area">
			<div class="slider-area">
				<div class="single-slider slider-center" style="background-image:url('{{ asset('site/images/sliders/1.jpg') }}');">
					<div class="container">
						<div class="row">
							<div class="col-lg-10 offset-lg-1 col-12">
								<div class="slider-text text-center">
									<h1>Welcome to The World's No 1 Inspiring Company</h1>
									<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
									<div class="button">
										<a href="{{  url('login')  }}" class="btn">LOGIN</a>
										<a href="{{  url('/')  }}" class="btn video-popup mfp-fade">GET IN TOUCH</a>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="single-slider slider-center" style="background-image:url('{!! asset('site/images/sliders/2.jpg') !!}');">
					<div class="container">
						<div class="row">
							<div class="col-lg-10 offset-lg-1 col-12">
								<div class="slider-text text-center">
									<h1>It is a long established fact that a reader will be distracted.</h1>
									<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
									<div class="button">
										<a href="{{ url('login') }}" class="btn">LOGIN</a>
										<a href="{{ url('/') }}" class="btn video-popup mfp-fade">GET IN TOUCH</a>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
			</div>
		</section>

		<section id="services" class="services archives section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h1><span>Our</span> Services</h1>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="fa fa-adjust"></i>
							<h2><a>Premium Quality Designs</a></h2>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="fa fa-lightbulb-o"></i>
							<h2><a>Creative Ideas</a></h2>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="fa fa-code"></i>
							<h2><a>Clean Code</a></h2>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="fa fa-file-text-o "></i>
							<h2><a>Documentation</a></h2>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="fa fa-life-ring"></i>
							<h2><a>Best Customer Support</a></h2>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<div class="single-service">
							<i class="fa fa-star-o"></i>
							<h2><a>High Performance System</a></h2>
							<p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
						</div>
					</div>
					</div>
				</div>
			</div>
		</section>

        <section class="call-to-action section" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12 wow fadeInUp">
						<div class="call-to-main">
							<h2>Inspire is the world's no 1 inspiring company.</h2>
							<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							<a href="{{  url('login')  }}" class="btn">Explore More</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="partners" class="partners section">
			<div class="container">
				<div class="row">
					<div class="col-12 wow fadeInUp text-center">
						<div class="section-title">
							<p class="color" style="font-size: 18px; font-weight: 700; letter-spacing: -0.05em;">
                                Be the first to apply for loan!</p>
                            <p class="mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                        </div>
                        <a href="{{  url('login')  }}" class="btn">Apply For Loan</a>
					</div>
				</div>
			</div>
		</section>
    </div>
@endsection

