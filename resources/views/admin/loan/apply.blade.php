@extends('admin.layouts.app')

@section('htmlheader_title')
	Apply {{ $module }}
@endsection

@section('contentheader_title')
    Apply {{ $module }}
@endsection

@section('contentheader_description')

@endsection

@section('breadcrumb_title')
    <ol class="breadcrumb">
        <li class="text-capitalize"><a href="{{ url('customer/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="text-capitalize"><a href="{{ url('customer/'.$module) }}"> {{ $module }}s</a></li>
        <li class="text-capitalize active"> Apply</li>
    </ol>
@endsection

@section('main-content')
<div class="nav-tabs-custom">
    @include('admin.'.$module.'.header')
    <div class="tab-content">
        <div class="tab-pane active">
        {!! Form::model(null, ['files' => true, 'autocomplete' => 'off']) !!}
        {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="box-body">
                        @php
                            $term = ['3' => '3 Months', '6' => '6 Months', '12' => '12 Months', '18' => '18 Months', '24' => '24 Months']
                        @endphp
                        <div class="form-group {!! $errors->has('term') ? 'has-error' : '' !!}">
                            {!! Form::label("Select Term *") !!}
                            {!! Form::select('term', $term, null, ['class' => 'select2 form-control', 'placeholder' => 'Select loan term', 'required']) !!}
                            <em class="error-msg">{!! $errors->first('term') !!}</em>
                        </div>
                        <div class="form-group {!! $errors->has('amount') ? 'has-error' : '' !!}">
                            {!! Form::label("Enter Amount *") !!}
                            {!! Form::number('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter loan amount', 'required', 'min' => '10000']) !!}
                            <em class="error-msg">{!! $errors->first('amount') !!}</em>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check-circle-o"></i> Submit
                        </button>
                        <a class="btn btn-default" href="{{ URL::previous() }}"><i class="fa fa-times-circle-o"></i> Cancel</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
