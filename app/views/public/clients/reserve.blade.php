@extends('layouts.public')
@section('content')
	{{ Form::open() }}
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
    <div class="grid_12" style="margin-bottom:15px;">
    <h3 class="panel-title">Calculation</h3>
    <div style="clear:both;"></div>
    <div class="reservation-form">
		<div class="reservation-holder">
			<div class="half">
				<label>Total Contract Price:</label>
				{{ Form::text('total_contract_price',number_format($property->price,2),array('id' => 'total_contract_price','class' => 'control-input','readonly' => true)) }}
			</div>
			<div class="half last">
				<label>Reservation Fee:</label>
				{{ Form::text('reservation_fee',number_format($property->reservation_fee,2),array('id' => 'reservation_fee','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>

		<div class="reservation-holder">
			<div class="half">
				<?php 
					$downpayment = (5 / 100) * $property->price;
					$equity = $property->price - $downpayment - $property->reservation_fee;
				?>
				<label>Downpayment(%) = <span id="dp">{{ number_format($downpayment,2) }}</span></label>
				<select name="downpayment" id="downpayment" class="control-input" style="height:31px;" onchange="calculate()">
				<?php for($i = 5;$i < 100;$i+=5):?>
					<option valuue="<?php echo $i;?>"><?php echo $i;?></option>
				<?php endfor;?>
				</select>
			</div>
			<div class="half last">
				<label>Equity:</label>
				{{ Form::text('equity',number_format($equity,2),array('id' => 'equity','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>

		<div class="reservation-holder">
			<div class="half">
				<label>Number of Months:</label>
				<input type="text" name="total_months" id="months" class="control-input" value="12" onkeyup="calculate()">
			</div>
			<div class="half last">
				<label>Montly Fee:</label>
				<?php $monthly_fee = $equity / 12;?>
				{{ Form::text('monthly_fee',number_format($monthly_fee,2),array('id' => 'monthly_fee','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>
    </div>
  </div> 
    <div class="grid_12" style="padding-bottom:35px;">
    <h3 class="panel-title">Client Information</h3>
    <div style="clear:both;"></div>
    <div class="reservation-form">
		<div class="reservation-holder">
			<div class="whole">
				<label>Select Your Agent:</label>
				{{ Form::select('agent_id',Agent::dropdown(),null,array('class' => 'control-input')) }}
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Firstname:</label>
				{{ Form::token() }}
				{{ Form::text('firstname',$user->first_name,array('placeholder' => 'First name','class' => 'control-input','readonly' => true)) }}
			</div>
			<div class="half last">
				<label>Lastname:</label>
				{{ Form::text('lastname',$user->last_name,array('placeholder' => 'Last name','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Landline Phone:</label>
				{{ Form::text('landline',$user->landline,array('placeholder' => 'Landline','class' => 'control-input','readonly' => true)) }}
			</div>
			<div class="half last">
				<label>Mobile Phone:</label>
				{{ Form::text('mobile',$user->mobile,array('placeholder' => 'Mobile Phone','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Email:</label>
				{{ Form::email('email',$user->email,array('placeholder' => 'Work / Job','class' => 'control-input','readonly' => true)) }}
			</div>
			<div class="half last">
				<label>Tin Number:</label>
				{{ Form::text('tin_number',$user->tin_number,array('placeholder' => '','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Home Address:</label>
				{{ Form::text('home_address',$user->home_address,array('placeholder' => 'Home Address','class' => 'control-input','readonly' => true)) }}
			</div>
			<div class="half last">
				<label>Work Address:</label>
				{{ Form::text('work_address',$user->work_address,array('placeholder' => 'Work Address','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Occupation:</label>
				{{ Form::text('occupation',$user->occupation,array('placeholder' => 'Work / Job','class' => 'control-input','readonly' => true)) }}
			</div>
			<div class="half last">
				<label>Company:</label>
				{{ Form::text('company',$user->company,array('placeholder' => 'Company Name','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="reservation-holder">
			<div class="half">
				<label>Unit Type:</label>
				{{ Form::select('unit_type',array('lot' => 'Lot Only', 'house and lot' => 'House and Lot'),null,array('class' => 'control-input')) }}
			</div>
			<div class="half last">
				<label>Payment Terms:</label>
				{{ Form::select('terms',array('cash' => 'Cash', 'installment' => 'Installment','pagibig' => 'Pag-Ibig','in-house' => 'In-House'),null,array('class' => 'control-input')) }}
			</div>
			<div style="clear:both;"></div>
			<br>
		</div>
		<div style="clear:both;"></div>
		<div class="reservation-holder" style="border:none;">
			<button type="submit" class="button-yellow" style="float:right;">Send Reservation</button><br>
		</div>
		<div style="clear:both;"></div>
    </div>
    <div style="clear:both;"></div>
  </div> 
  {{ Form::close() }}
@stop