@extends('site.layouts.default')

@section('htmlheader_title')
    Log In
@endsection

@section('main-content')
<section class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Login</h2>
                <ul>
                    <li><a href="{{ url('/') }}"><i class="fa fa-home"></i>Home</a></li>
                    <li class="active"><a href="#"><i class="fa fa-user"></i>Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="login" class="login section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h1><span>Log</span> In</h1>
                    <p>Please login to continue. </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3 col-sm-12">
                <div class="login-main">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="form-main">
                                @if(session('success'))<div class="alert alert-success">{!! session('success') !!}</div>@endif
                                @if(session('error'))<div class="alert alert-danger">{!! session('error') !!}</div>@endif
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <i class="fa fa-exclamation-circle"></i> <strong>Whoops!</strong> There were some problems with your input.
                                        <ul>
                                            @if($errors->first('login_email'))
                                            <li>
                                                <a class="error-msg"><i class="fa fa-times-circle"></i> {!! $errors->first('login_email') !!}</a>
                                            </li>
                                            @endif
                                            @if($errors->first('login_pass'))
                                            <li>
                                                <a class="error-msg"><i class="fa fa-times-circle"></i> {!! $errors->first('login_pass') !!}</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                                {!! Form::model(null, ['autocomplete' => 'off', 'class' => 'form']) !!}
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            {!!Form::text('login_email', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required'])!!}
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group">
                                            {!!Form::password('login_pass', ['class' => 'form-control', 'placeholder' => 'Password', 'required'])!!}
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <div class="form-group button">
                                            <button type="submit" class="btn primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
