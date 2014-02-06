@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-8" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Transaction</h3>
            </div>
            <div class="panel-body">
                @include('layouts.notifications')
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                <form action="{{ URL::to('admin/transactions/'.$transaction->id.'/update/') }}" method="POST">
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


