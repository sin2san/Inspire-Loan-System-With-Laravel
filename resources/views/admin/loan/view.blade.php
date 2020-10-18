@extends('admin.layouts.app')

@section('htmlheader_title')
	#{{ $singleData->loan_id }} | Loan History
@endsection

@section('contentheader_title')
    <span>View {{ $module }} ID: #{{ $singleData->loan_id }}</span>
@endsection

@section('contentheader_description')

@endsection

@section('breadcrumb_title')
    <ol class="breadcrumb">
        <li class="text-capitalize"><a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }}" @else href="{{ url('admin/dashboard') }}" @endif><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="text-capitalize"><a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/'.$module.'s') }}" @else href="{{ url('admin/'.$module.'s') }}" @endif> {{ $module }}s</a></li>
        <li class="text-capitalize active">#{{ $singleData->loan_id }}</li>
    </ol>
@endsection

@section('main-content')
<div class="nav-tabs-custom">
    @include('admin.'.$module.'.header')
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="box-header">
                <h3 class="box-title"> #{{ $singleData->loan_id }}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-bordered table-view">
                            <tr><th>Name</th> <td>{{ $singleData->user->name }}</td> </tr>
                            <tr><th>Amount ($)</th> <td>{{ number_format($singleData->amount, 2) }}</td> </tr>
                            <tr><th>Status</th> <td>@if($singleData->status == 0) <span class="label label-warning"><i class="fa fa-exclamation-circle"></i> Pending</span> @elseif($singleData->status == 1) <span class="label label-success"><i class="fa fa-check-circle"></i> Approved</span> @elseif($singleData->status == 2) <span class="fa fa-danger"><i class="fa fa-times-circle"></i> Rejected</span> @endif</td> </tr>
                            <tr><th>Outstanding Amount ($)</th> <td>@if($singleData->outstanding_amount == 0) <span class="label label-success"><i class="fa fa-check-circle"></i> Paid</span> @else <span class="text-red"> {{ number_format($singleData->outstanding_amount, 2) }} </span> @endif</td> </tr>
                            <tr><th>Date</th> <td>{{ $singleData->created_at }}</td> </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="text-uppercase text-bold"> Payment History</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Amount ($)</th>
                                        <th>Week</th>
                                        <th>Payment Made On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 0; @endphp
                                    @foreach ($payments as $row)
                                        @php
                                            $count++;
                                        @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ number_format($row->amount, 2) }}</td>
                                            <td>{{ $row->week }}</td>
                                            <td>{{ $row->date }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
