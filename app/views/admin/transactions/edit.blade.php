@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-8" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Transaction</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                <form action="{{ URL::to('admin/transactions/'.$transaction->id.'/update/') }}" method="POST">
                <div class="form-group row">
                    <div class="col-lg-6">
                        {{ Form::label('reference_number', 'First name:') }}
                        {{ Form::text('firstname',$transaction->firstname,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('reference_number', 'Last name:') }}
                        {{ Form::text('lastname',$transaction->lastname,array('class' => 'form-control')) }}
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {{ Form::label('reference_number', 'Contact Number:') }}
                        {{ Form::text('contact_number',$transaction->contact_number,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('reference_number', 'Email Address:') }}
                        {{ Form::text('email',$transaction->email,array('class' => 'form-control')) }}
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        {{ Form::label('reference_number', 'Customer Address:') }}
                        {{ Form::textarea('address',$transaction->address,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('reference_number', 'Reference Number:') }}
                    {{ Form::text('reference_number',$transaction->reference_number,array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('property_id', 'Model Number:') }}
                    {{ Form::select('property_id',Property::dropdown(),$transaction->property_id,array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('reservation_id', 'Reservation ID:') }}
                    {{ Form::select('reservation_id',Reservation::dropdown(),$transaction->reservation_id,array('class' => 'form-control')) }}
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        {{ Form::label('remarks', 'Remarks:') }}
                        {{ Form::textarea('remarks',$transaction->remarks,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('amount', 'Amount Payable:') }}
                    {{ Form::text('amount',$transaction->amount,array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('status', 'Status:') }}
                    {{ Form::select('status', array('Paid' => 'Paid', 'Pending' => 'Pending','Cancelled' => 'Cancelled'),$transaction->status,array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Save Invoice', array('class' => 'btn btn-info')) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop


