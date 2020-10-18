@extends('admin.layouts.app')

@section('htmlheader_title')
	Options
@endsection

@section('contentheader_title')
    Options
@endsection

@section('contentheader_description')
    Manage website options
@endsection

@section('breadcrumb_title')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"> Options</li>
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
                        <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                            {!! Form::label("Meta Title") !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter meta title']) !!}
                            <em class="error-msg">{!! $errors->first('title') !!}</em>
                        </div>
                        <div class="form-group {!! $errors->has('keywords') ? 'has-error' : '' !!}">
                            {!! Form::label("Meta Keywords") !!}
                            {!! Form::text('keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter meta keywords']) !!}
                            <em class="error-msg">{!! $errors->first('keywords') !!}</em>
                        </div>
                        <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                            {!! Form::label("Meta Description") !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter meta description']) !!}
                            <em class="error-msg">{!! $errors->first('description') !!}</em>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group {!! $errors->has('logo') ? 'has-error' : '' !!}">
                            {!! Form::label("Logo") !!}
                            {!! Form::file('logo', ['accept'=>'image/*']) !!}
                            @if ($singleData->logo)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="image-box img-thumbnail" style="background-image: url('{{ asset('storage/options/'.$singleData->logo) }}');">
                                        <div class="image-close"><a href="{{ url('admin/options/delete-logo') }}"><i class="fa fa-close"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <em class="error-msg">{!! $errors->first('logo') !!}</em>

                        <div class="form-group {!! $errors->has('favicon') ? 'has-error' : '' !!}">
                            {!! Form::label("Favicon") !!}
                            {!! Form::file('favicon', ['accept'=>'image/*']) !!}
                            @if($singleData->favicon)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="image-box img-thumbnail" style="background-image: url('{{ asset('storage/options/'.$singleData->favicon) }}');">
                                        <div class="image-close"><a href="{{ url('admin/options/delete-favicon') }}"><i class="fa fa-close"></i></a></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <em class="error-msg">{!! $errors->first('favicon') !!}</em>

                    </div>
                </div>
                <div class="col-md-8 col-md-pull-4">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12 form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                                {!! Form::label("Site Name *") !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter the site name']) !!}
                                <em class="error-msg">{!! $errors->first('name') !!}</em>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group {!! $errors->has('phone') ? 'has-error' : '' !!}">
                                {!! Form::label("Phone No") !!}
                                {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter phone number']) !!}
                                <em class="error-msg">{!! $errors->first('phone') !!}</em>
                            </div>
                            <div class="col-md-6 form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
                                {!! Form::label("Email Address *") !!}
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email address']) !!}
                                <em class="error-msg">{!! $errors->first('email') !!}</em>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group {!! $errors->has('mobile') ? 'has-error' : '' !!}">
                                {!! Form::label("Mobile No") !!}
                                {!! Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => 'Enter mobile number']) !!}
                                <em class="error-msg">{!! $errors->first('mobile') !!}</em>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 form-group {!! $errors->has('company_name') ? 'has-error' : '' !!}">
                                {!! Form::label("Site developed by") !!}
                                {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name']) !!}
                                <em class="error-msg">{!! $errors->first('company_name') !!}</em>
                            </div>
                            <div class="col-md-6 form-group {!! $errors->has('company_web_url') ? 'has-error' : '' !!}">
                                {!! Form::label("URL") !!}
                                {!! Form::text('company_web_url', null, ['class' => 'form-control', 'placeholder' => 'Company Web URL']) !!}
                                <em class="error-msg">{!! $errors->first('company_web_url') !!}</em>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle-o"></i> Save
                        </button>
                        <a class="btn btn-default"  href="{{ url('admin/dashboard') }}"><i class="fa fa-times-circle-o"></i> Cancel</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
