@extends('layouts.master')
@section('content')
<section class="content">
	<div style="clearme"></div>
	<div id="reservation-form">
		<h3>Reservation Form - Buyers Information</h3>
		<div class="reservation-holder">
		    @if ($errors->any())
		    <div class="alert alert-danger">
		        <h4>Warning!</h4>
		        {{ implode('', $errors->all(':message</br>')) }}
		    </div>
		    @endif
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-dismissable">
			  <strong>Success:</strong> {{ $message }}
			</div>
			{{ Session::forget('success') }}
			@endif
			{{ Form::open() }}
			<div class="half">
				<label>Firstname:</label>
				{{ Form::token() }}
				{{ Form::text('firstname',null,array('placeholder' => 'First name','class' => 'control-input')) }}
			</div>
			<div class="half">
				<label>Lastname:</label>
				{{ Form::text('lastname',null,array('placeholder' => 'Last name','class' => 'control-input')) }}
			</div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Landline Phone:</label>
				{{ Form::text('phone',null,array('placeholder' => 'Landline','class' => 'control-input')) }}
			</div>
			<div class="half">
				<label>Mobile Phone:</label>
				{{ Form::text('mobile',null,array('placeholder' => 'Mobile Phone','class' => 'control-input')) }}
			</div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Email:</label>
				{{ Form::email('email',null,array('placeholder' => 'Work / Job','class' => 'control-input')) }}
			</div>
			<div class="half">
				<label>Tin Number:</label>
				{{ Form::text('tin_number',null,array('placeholder' => '','class' => 'control-input')) }}
			</div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Home Address:</label>
				{{ Form::text('home_address',null,array('placeholder' => 'Home Address','class' => 'control-input')) }}
			</div>
			<div class="half">
				<label>Work Address:</label>
				{{ Form::text('work_address',null,array('placeholder' => 'Work Address','class' => 'control-input')) }}
			</div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Nature Of Work:</label>
				{{ Form::text('work',null,array('placeholder' => 'Work / Job','class' => 'control-input')) }}
			</div>
			<div class="half">
				<label>Company Name:</label>
				{{ Form::text('company',null,array('placeholder' => 'Company Name','class' => 'control-input')) }}
			</div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Unit Type:</label>
				{{ Form::select('unit_type',array('lot' => 'Lot Only', 'house and lot' => 'House and Lot'),null,array('class' => 'control-input')) }}
			</div>
			<div class="half">
				<label>Payment Terms:</label>
				{{ Form::select('terms',array('cash' => 'Cash', 'installment' => 'Installment','pagibig' => 'Pag-Ibig','in-house' => 'In-House'),null,array('class' => 'control-input')) }}
			</div>
		</div>
		<div class="reservation-holder" style="border:none;">
			{{ Form::submit("Submit Reservation",array('class' => 'reservation-button submit-reservation')) }}
		</div>
		{{ Form::close() }}
	</div>
<a href="#top" class="go-top">Go to top of page</a>
</section>
@stop