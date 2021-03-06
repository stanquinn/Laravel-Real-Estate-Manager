@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-8" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create Agent Account</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                {{ Form::open(array('route' => 'admin.agents.store')) }}
                <div class="form-group row">
                    <div class="col-lg-6">
                        {{ Form::label('', 'First name:') }}
                        {{ Form::text('first_name',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('', 'Last name:') }}
                        {{ Form::text('last_name',null,array('class' => 'form-control')) }}
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {{ Form::label('', 'Email:') }}
                        {{ Form::email('email',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('', 'Phone:') }}
                        {{ Form::text('phone',null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::submit('Create Account', array('class' => 'btn btn-info')) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop


