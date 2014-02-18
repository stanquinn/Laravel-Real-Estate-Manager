@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-5" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Give Commission to {{ $agent->first_name  }} {{ $agent->last_name }}</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                {{ Form::open() }}
                <div class="form-group">
                    {{ Form::label('name', 'Action:') }}
                    {{ Form::select('action',array('add' => 'Add', 'deduct' => 'Deduct'),'add',array('class' => 'form-control action')) }}
                </div>
                <div class="form-group prop">
                    {{ Form::label('name', 'Property ID:') }}
                    {{ Form::text('property_id',null,array('class' => 'form-control')) }}
                </div>
                <div class="form-group prop">
                    {{ Form::label('name', 'Client ID/User ID:') }}
                    {{ Form::text('user_id',null,array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Amount:') }}
                    {{ Form::text('amount',null,array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Remarks:') }}
                    {{ Form::textarea('remarks',null,array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop


