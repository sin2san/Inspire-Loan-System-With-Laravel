@extends('admin.layouts.app')

@section('htmlheader_title')
    Service not available
@endsection

@section('contentheader_title')
    Service not available
@endsection

@section('contentheader_description')
@endsection

@section('breadcrumb_title')
    <ol class="breadcrumb">
        <li><a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }}" @else href="{{ url('admin/dashboard') }}" @endif><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">503</li>
    </ol>
@endsection

@section('main-content')
    <div class="error-page">
        <h2 class="headline text-red">503</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red"></i> Oops! Service not available</h3>
            <p>
                We could not find the service you were looking for. Meanwhile, you may return to <a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }}" @else href="{{ url('admin/dashboard') }}" @endif>dashboard</a> or try using the search form.
            </p>
            <form class='search-form'>
                <div class='input-group'>
                    <input type="text" name="search" class='form-control' placeholder="Search something ..."/>
                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
