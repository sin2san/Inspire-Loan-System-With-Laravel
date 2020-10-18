@extends('admin.layouts.app')

@section('htmlheader_title')
    Profile
@endsection

@section('contentheader_title')
    Profile
@endsection

@section('contentheader_description')
        Manage My Profile
@endsection

@section('breadcrumb_title')
    <ol class="breadcrumb">
        <li><a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }}" @else href="{{ url('admin/dashboard') }}" @endif><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">My Profile</li>
    </ol>
@endsection

@section('main-content')
    @include('admin.partials.error')
    <div class="nav-tabs-custom">
        <div class="tab-content">
            <div class="tab-pane active">
                {!! Form::model($singleData, ['files' => true, 'autocomplete' => 'off']) !!}
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-4 col-md-push-8">
                        <div class="box-body">
                            <div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
                                {!! Form::label("Profile Image") !!}
                                {!! Form::file('image') !!}
                                @if ($singleData->id && !empty($singleData->image))
                                <div class="row">
                                    <div class="col-md-12">
                                        @if($singleData->image)
                                            <div class="image-box img-thumbnail" style="background-image: url('{{ asset('storage/users/'.$singleData->image) }}');">
                                                <div class="image-close">
                                                    <a  @if(Auth::user()->hasRole('customer')) href="{{ url('customer/user/delete-image') }}" @else href="{{ url('admin/user/delete-image') }}" @endif><i class="fa fa-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <img src="{{ asset('admin/img/user.png') }}" alt="Profile Image" class="img-thumbnail" width="200">
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                            <em class="error-msg">{!! $errors->first('image') !!}</em>
                            <em class="error-msg">The profile image dimension must be less than 300px * 300px</em>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-pull-4">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6 form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                    {!! Form::label("Name *") !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter name']) !!}
                                    <em class="error-msg">{!! $errors->first('name') !!}</em>
                                </div>
                                <div class="col-sm-6 form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                    {!! Form::label("Email (username) *") !!}
                                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email (Username)']) !!}
                                    <em class="error-msg">{!! $errors->first('email') !!}</em>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                                    {!! Form::label("Password *") !!}
                                    {!! Form::password('password', ['id' => 'pass2', 'class'=>'form-control', 'placeholder' => 'Enter password']) !!}
                                    <em class="error-msg">{!! $errors->first('password') !!}</em>
                                </div>
                                <div class="col-sm-6 form-group {!! $errors->has('password') ? 'has-error' : '' !!}">
                                    {!! Form::label("Confirm password *") !!}
                                    {!! Form::password('password_confirmation', ['id' => 'pass1', 'class'=>'form-control', 'oninput' => 'passConfirming()', 'placeholder' => 'Enter confirm password']) !!}
                                    <em class="error-msg">{!! $errors->first('password') !!}</em>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-check-circle-o"></i> Save
                                </button>
                                <a class="btn btn-default" @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }}" @else href="{{ url('admin/dashboard') }}" @endif><span class="fa fa-times-circle-o"></span> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
