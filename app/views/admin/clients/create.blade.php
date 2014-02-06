@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-8" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create Client Account</h3>
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
                        {{ Form::label('', 'Password:') }}
                        {{ Form::password('password',array('class' => 'form-control')) }}
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {{ Form::label('', 'Landline:') }}
                        {{ Form::text('landline',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('', 'Mobile:') }}
                        {{ Form::text('mobile',null,array('class' => 'form-control')) }}
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {{ Form::label('', 'Work Address:') }}
                        {{ Form::text('work_address',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('', 'Home Address:') }}
                        {{ Form::text('home_address',null,array('class' => 'form-control')) }}
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {{ Form::label('', 'Company:') }}
                        {{ Form::text('company',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('', 'Occupation:') }}
                        {{ Form::text('occupation',null,array('class' => 'form-control')) }}
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        {{ Form::label('', 'Tin Number:') }}
                        {{ Form::text('tin_number',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="col-lg-6">
                        {{ Form::label('', 'Activated:') }}
                        {{ Form::select('activated', array('1' => 'True', '0' => 'False'),null,array('class' => 'form-control')) }}
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


