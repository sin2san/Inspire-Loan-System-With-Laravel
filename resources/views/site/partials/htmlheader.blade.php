<!DOCTYPE html>
<meta charset="UTF-8">
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<title> @yield('htmlheader_title', 'Page not found') | {{ $option->name }}</title>

<meta name="description" content="{{ $option->description }}">
<meta name="keywords" content="{{ $option->keywords }}">
<meta name="author" content="sinthusan">

@if($option->favicon)
    <link rel="shortcut icon" href="{{ asset('storage/options/'.$option->favicon) }}">
@else
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.png') }}">
@endif

 <!-- FONT -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">

<!-- BOOTSTRAP CSS -->
<link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}">

<!-- FONT AWESOME CSS -->
<link rel="stylesheet" href="{{ asset('site/css/font-awesome.min.css') }}">

<!-- SLICK NAV CSS -->
<link rel="stylesheet" href="{{ asset('site/css/slicknav.min.css') }}">

<!-- CUBE PORTFOLIO CSS -->
<link rel="stylesheet" href="{{ asset('site/css/cubeportfolio.min.css') }}">

<!-- MAGNIFIC POPUP CSS -->
<link rel="stylesheet" href="{{ asset('site/css/magnific-popup.min.css') }}">

<!-- FANCY BOX CSS -->
<link rel="stylesheet" href="{{ asset('site/css/jquery.fancybox.min.css') }}">

<!-- NICE SELECT CSS -->
<link rel="stylesheet" href="{{ asset('site/css/niceselect.css') }}">

<!-- OWL CAROUSEL CSS -->
<link rel="stylesheet" href="{{ asset('site/css/owl.theme.default.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}">

<!-- SLICK SLIDER CSS -->
<link rel="stylesheet" href="{{ asset('site/css/slickslider.min.css') }}">

<!-- ANIMATE CSS -->
<link rel="stylesheet" href="{{ asset('site/css/animate.min.css') }}">

<!-- STYLESHEET CSS -->
<link rel="stylesheet" href="{{ asset('site/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/responsive.css') }}">

<!-- COLOR CSS -->
<link rel="stylesheet" href="{{ asset('site/css/color.css') }}">
