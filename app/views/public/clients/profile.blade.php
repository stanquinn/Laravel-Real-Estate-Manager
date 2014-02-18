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
                    <form action="" method="POST" id="userform">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'First name:') }}<span class="red">*</span>
                            {{ Form::text('first_name',$client->first_name,array('class' => 'form-control')) }}
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Last name:') }}<span class="red">*</span>
                            {{ Form::text('last_name',$client->last_name,array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Tin Number:') }}<span class="red">*</span><div style="clear:both;"></div>
                            <div class="tin-control">{{ Form::text('tin_number_1',$tin_number[0],array('class' => 'form-control','id' => 'tin_number_1')) }}<span>-</span></div>
                            <div class="tin-control">{{ Form::text('tin_number_2',$tin_number[1],array('class' => 'form-control','id' => 'tin_number_2')) }}<span>-</span></div>
                            <div class="tin-control">{{ Form::text('tin_number_3',$tin_number[2],array('class' => 'form-control','id' => 'tin_number_3')) }}<span>-</span></div>
                            <div class="tin-control">{{ Form::text('tin_number_4',$tin_number[3],array('class' => 'form-control','id' => 'tin_number_4')) }}</div>
                            <input type="hidden" name="tin_number" value="{{ $client->tin_number }}" id="tin_number"/>
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Email:') }}<span class="red">*</span>
                            <div style="clear:both;"></div>
                            <div class="form-email-control">
                                {{ Form::text('email_address',$email[0],array('class' => 'form-control email-address','id' => 'email-address')) }}<span>@</span>
                                {{ Form::text('email_tld',$email[1],array('class' => 'form-control email-tld','id' => 'email-tld')) }}
                                <input type="hidden" value="{{ $client->email }}" id="email" name="email"/>
                            </div>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Password:') }}<span class="red">*</span><div style="clear:both;"></div>
                            {{ Form::password('password',array('class' => 'form-control')) }}
                        </div> 
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Password Confirmation:') }}<span class="red">*</span><div style="clear:both;"></div>
                            {{ Form::password('password_confirmation',array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Landline:') }}
                            {{ Form::text('landline',$client->landline,array('class' => 'form-control','id' => 'landline','placeholder' => '')) }}
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Mobile:') }}<span class="red">*</span><div style="clear:both;"></div>
                            {{ Form::text('mobile',$client->mobile,array('class' => 'form-control','id' => 'mobile')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 address-field">
                            {{ Form::label('', 'Work Address:') }}<span class="red">*</span><div style="clear:both;"></div>
                            {{ Form::text('work_street',$work_address[0],array('class' => 'form-control first','placeholder' => 'Street')) }}
                            {{ Form::text('work_barangay',$work_address[1],array('class' => 'form-control','placeholder' => 'Barangay')) }}
                            {{ Form::text('work_city',$work_address[2],array('class' => 'form-control','placeholder' => 'City')) }}
                            {{ Form::text('work_province',$work_address[3],array('class' => 'form-control','placeholder' => 'Province')) }}
                            {{ Form::text('work_zipcode',$work_address[4],array('class' => 'form-control','placeholder' => 'Zipcode')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 address-field">
                            {{ Form::label('', 'Home Address:') }}<span class="red">*</span><div style="clear:both;"></div>
                            {{ Form::text('home_street',$home_address[0],array('class' => 'form-control first','placeholder' => 'Street')) }}
                            {{ Form::text('home_barangay',$home_address[1],array('class' => 'form-control','placeholder' => 'Barangay')) }}
                            {{ Form::text('home_city',$home_address[2],array('class' => 'form-control','placeholder' => 'City')) }}
                            {{ Form::text('home_province',$home_address[3],array('class' => 'form-control','placeholder' => 'Province')) }}
                            {{ Form::text('home_zipcode',$home_address[4],array('class' => 'form-control','placeholder' => 'Zipcode')) }}
                        </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6">
                            {{ Form::label('', 'Company:') }}
                            {{ Form::text('company',$client->company,array('class' => 'form-control')) }}
                        </div>
                        <div class="col-lg-6 last">
                            {{ Form::label('', 'Occupation:') }}
                            {{ Form::text('occupation',$client->occupation,array('class' => 'form-control')) }}
                        </div> 
                    </div>
                    <div class="form-group">
                        <button class="button-yellow" id="submit">Update Account</button>
                    </div>
                    {{ Form::close() }}
                    <div class="clear"></div>
                </div>
            </div>
        </div>  
    </div> 
@stop