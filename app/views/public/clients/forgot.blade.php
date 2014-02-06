@extends('layouts.public')
@section('content')
    <div class="grid_12" id="left">
        <div class="login-panel">
            <h3 class="panel-title">Client Login</h3>
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
                        <div class="form-group">
                            {{ Form::label('Email Address:') }}
                            {{ Form::email('email',null,array('class' => 'form-control'))}}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Send Password',array('class' => 'button-yellow')) }}
                            <p><br><a href="{{ URL::to('clients/login') }}">Back To Login Page</a></p>
                        </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>  
    </div> 
@stop