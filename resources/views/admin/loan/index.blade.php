@extends('admin.layouts.app')

@section('htmlheader_title')
	Loan | {{ Auth::user()->name }}
@endsection

@section('contentheader_title')
    {{ $module }} History</span>
@endsection

@section('contentheader_description')
    Manage loans
@endsection

@section('breadcrumb_title')
    <ol class="breadcrumb">
        <li><a @if(Auth::user()->hasRole('customer')) href="{{ url('customer/dashboard') }}" @else href="{{ url('admin/dashboard') }}" @endif><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="text-capitalize active">{{ $module }}s</li>
    </ol>
@endsection

@section('main-content')
<div class="nav-tabs-custom">
    @include('admin.'.$module.'.header')
    <div class="tab-content">
        <div class="tab-pane active">
            <div class="box-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Loan ID</th>
                                @if(Auth::user()->hasRole('admin'))
                                    <th>Name</th>
                                @endif
                                <th>Loan Term</th>
                                <th>Amount ($)</th>
                                <th>Outstanding Amount ($)</th>
                                @if(Auth::user()->hasRole('customer'))
                                    <th>Remaing Weeks</th>
                                @endif
                                <th>Applied On</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 0; @endphp
                            @foreach ($allData as $row)
                                @php
                                    $count++;
                                    $id = \Crypt::encrypt($row->id);

                                    //CALCULATE WEEKS AND WEEKLY AMOUNT
                                    $date = $row->created_at;
                                    $addedMonth = $row->created_at->addMonth($row->term);
                                    $weeks = $date->diffInWeeks($addedMonth);

                                    $today = Carbon\Carbon::now();
                                    $remainingWeeks = $today->diffInWeeks($addedMonth);

                                    $weeklyAmount = $row->amount / $weeks;
                                    if($weeklyAmount < $row->outstanding_amount)
                                    {
                                        $weeklyAmountPay = $weeklyAmount;
                                    }else{
                                        $weeklyAmountPay = $row->outstanding_amount;
                                    }

                                    //GET WEEK
                                    $payment = App\Payment::where('loan_id', $row->id)->orderBy('id', 'DESC')->first();
                                    if($payment){
                                        $weekNo = $payment->week + 1;
                                    }else{
                                        $weekNo = 1;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $row->loan_id }}</td>
                                    @if(Auth::user()->hasRole('admin'))
                                        <td>{{ $row->user->name }}</td>
                                    @endif
                                    <td>{{  $row->term  }}</td>
                                    <td>{{ number_format($row->amount, 2) }}</td>
                                    <td>
                                        @if($row->outstanding_amount == 0)
                                            <span class="label label-success"><i class="fa fa-check-circle"></i> Paid</span>
                                        @else
                                            <span class="text-red">{{ number_format($row->outstanding_amount, 2) }}</span>
                                        @endif
                                    </td>
                                    @if(Auth::user()->hasRole('customer'))
                                        <td>{{ $remainingWeeks }}</td>
                                    @endif
                                    <td>{{ $row->created_at->format('d M, Y') }}</td>
                                    <td>
                                        @if($row->status == 0)
                                            <span class="label label-warning"><i class="fa fa-exclamation-circle"></i> Pending</span>
                                        @elseif($row->status == 1)
                                            <span class="label label-success"><i class="fa fa-check-circle"></i> Approved</span>
                                        @elseif($row->status == 2)
                                            <span class="label label-danger"><i class="fa fa-times-circle"></i> Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->hasRole('customer'))
                                            <div class="modal fade" id="modal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modal{{ $id }}" style="font-weight: 600;">Pay for loan id #{{ $row->loan_id }}</h5>
                                                            <h5><span class="label label-danger"><i class="fa fa-calendar"></i> Week {{ $weekNo }}</span></h5>
                                                        </div>
                                                        <style type="text/css">
                                                            label{
                                                                font-weight: 600;
                                                            }
                                                        </style>
                                                        <div class="modal-body">
                                                            {!! Form::model(null, ['url' => 'customer/loan/'.$id.'/update-payment', 'files' => true, 'autocomplete' => 'off', 'method' => 'post']) !!}
                                                            {!! csrf_field() !!}
                                                            <div class="form-group {!! $errors->has('amount') ? 'has-error' : '' !!}">
                                                                {!! Form::label("Pay Amount *") !!}
                                                                <br>
                                                                {!! Form::text('amount', $weeklyAmountPay ? (round($weeklyAmountPay)) : null, ['class' => 'form-control', 'placeholder' => 'Enter amount', 'required']) !!}
                                                                <br>
                                                                <em class="error-msg">{!! $errors->first('amount') !!}</em>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                                                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @if($row->status == 1)
                                                @if(!$row->outstanding_amount == 0)
                                                    <button type="button" class="btn btn-sm btn-success text-bold" data-toggle="modal" data-target="#modal{{ $id }}"><i class="fa fa-usd"></i> PAY</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success text-bold" disabled><i class="fa fa-usd"></i> PAY</button>
                                                @endif
                                                @if(count($row->payment)>0)
                                                    <a href="{{ url('customer/'.$module.'/'.$id.'/view') }}" class="btn btn-sm btn-primary text-bold"><i class="fa fa-file-text"></i> HISTORY</a>
                                                @else
                                                    <a class="btn btn-sm btn-primary text-bold" disabled><i class="fa fa-file-text"></i> HISTORY</a>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-sm btn-success text-bold" disabled><i class="fa fa-usd"></i> PAY</button>
                                                <a class="btn btn-sm btn-primary text-bold" disabled><i class="fa fa-file-text"></i> HISTORY</a>
                                            @endif
                                        @else
                                            @if($row->status == 0)
                                                <a href="{{ url('admin/'.$module.'/'.$id.'/update-status-approve/update') }}" class="btn btn-sm btn-success text-bold"> <i class="fa fa-check-circle"></i> APPROVE</a>
                                                <a href="{{ url('admin/'.$module.'/'.$id.'/update-status-reject/update') }}" class="btn btn-sm btn-danger text-bold"> <i class="fa fa-times-circle"></i> REJECT</a>
                                            @else
                                                <a class="btn btn-sm btn-success text-bold" disabled><i class="fa fa-check-circle"></i> APPROVE</a>
                                                <a class="btn btn-sm btn-danger text-bold" disabled><i class="fa fa-times-circle"></i> REJECT</a>
                                            @endif

                                            @if($row->status == 1)
                                                @if(count($row->payment)>0)
                                                    <a href="{{ url('admin/'.$module.'/'.$id.'/view') }}" class="btn btn-sm btn-primary text-bold"><i class="fa fa-file-text"></i> HISTORY</a>
                                                @else
                                                    <a class="btn btn-sm btn-primary text-bold" disabled><i class="fa fa-file-text"></i> HISTORY</a>
                                                @endif
                                            @else
                                                <a class="btn btn-sm btn-primary text-bold" disabled><i class="fa fa-file-text"></i> HISTORY</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
