@extends('layouts.public')
@section('content')
    <div class="grid_12" id="left">
        <div class="registration-panel">
            <h3 class="panel-title">Client Registration</h3>
            <div class="login-wrapper">
                <div class="login-inner">
                    @include('layouts.notifications')
                    @if(Session::has('errors'))
                    <div class="alert alert-danger">
                        <h4>Warning!</h4>
                        @foreach($errors->all() as $message)
                        {{ $message }}<br>
                        @endforeach
                    </div><!--alert-->
                    @endif
                    {{ Form::open() }}
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'First name:') }}
                            {{ Form::text('first_name',null,array('class' => 'form-control')) }}
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Last name:') }}
                            {{ Form::text('last_name',null,array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Tin Number:') }}
                            {{ Form::text('tin_number',null,array('class' => 'form-control')) }}
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Email:') }}
                            {{ Form::email('email',null,array('class' => 'form-control')) }}     
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Password:') }}
                            {{ Form::password('password',array('class' => 'form-control')) }}
                        </div> 
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Password Confirmation:') }}
                            {{ Form::password('password_confirmation',array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Landline:') }}
                            {{ Form::text('landline',null,array('class' => 'form-control')) }}
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Mobile:') }}
                            {{ Form::text('mobile',null,array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Work Address:') }}
                            {{ Form::text('work_address',null,array('class' => 'form-control')) }}
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Home Address:') }}
                            {{ Form::text('home_address',null,array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Company:') }}
                            {{ Form::text('company',null,array('class' => 'form-control')) }}
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Occupation:') }}
                            {{ Form::text('occupation',null,array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Create Account', array('class' => 'button-yellow')) }}
                    </div>
                    {{ Form::close() }}
                    <div class="clear"></div>
                </div>
            </div>
        </div>  
    </div> 
@stop