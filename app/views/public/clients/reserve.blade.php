@extends('layouts.public')
@section('content')
	{{ Form::open() }}
    <div class="grid_5" style="margin-bottom:15px;">
    <h3 class="panel-title">Mortgage Calculator</h3>
    <div style="clear:both;"></div>
		<div class="reservation-form">
		<h3 class="heading">{{ $property->name }}<span>Model # {{ $property->model_number }}</span></h3>
		<table class="item-info-table calculator">
		<tbody><tr>
		    <td class="item-info-label">Price</td>
		    <td>₱<span id="total_contract_price_span">{{ number_format($property->price,2) }}</span>
		    	{{ Form::hidden('total_contract_price',number_format($property->price,2),array('id' => 'total_contract_price','class' => 'control-input','readonly' => true)) }}
		    </td>
		</tr>
		<tr>
		    <td class="item-info-label">Reservation Fee</td>
		    <td>₱<span id="total_contract_price_span">{{ number_format($property->reservation_fee,2) }}</span>
		    	{{ Form::hidden('reservation_fee',number_format($property->reservation_fee,2),array('id' => 'reservation_fee','class' => 'control-input','readonly' => true)) }}
		    </td>
		</tr>
		<tr>
		    <td class="item-info-label">Equity</td>
		    <td>₱<span id="total_contract_price_span">{{ number_format($property->equity,2) }}</span>
		    	{{ Form::hidden('equity',number_format($property->equity,2),array('id' => 'equity','class' => 'control-input','readonly' => true)) }}
		    </td>
		</tr>
		<tr>
			<?php 
				$downpayment = (15 / 100) * $property->price;
				$loanable_amount = $property->price - $downpayment - $property->reservation_fee;
			?>
		    <td class="item-info-label">Downpayment</td>
		    <td>
		    	₱<span id="dp">{{ number_format($downpayment,2) }}</span>
		    </td>
		</tr>
		<tr>
		    <td class="item-info-label"></td>
		    <td>
		    	<input type="text" name="downpayment" id="downpayment" class="control-input" value="15" onchange="checkNan(this)">
		    	<select name="conversion" id="conversion">
		    		<option value="fixed">Pesos</option>
		    		<option value="percentage" selected>%</option>
		    	</select>
		    </td>
		</tr>
		<tr>
		    <td class="item-info-label">Balance</td>
		    <td>{{ Form::text('loanable_amount',number_format($loanable_amount,2),array('id' => 'loanable_amount','class' => 'control-input','readonly' => true)) }}</td>
		</tr>
		<tr>
		    <td class="item-info-label">Number of Months</td>
		    <td><input type="text" name="total_months" id="months" class="control-input" value="12" onchange="checkNan(this)"></td>
		</tr>
		<tr>
			<?php $monthly_fee = $loanable_amount / 12;?>
		    <td class="item-info-label">Monthly Fee</td>
		    <td>{{ Form::text('monthly_fee',number_format($monthly_fee,2),array('id' => 'monthly_fee','class' => 'control-input','readonly' => true)) }}</td>
		</tr>
		</tbody>
		</table>
		<div class="reservation-holder" style="border:none;">
		<button type="button" class="button-yellow" style="float:right;" onclick="calculate()">Calculate</button>
		<button type="button" class="button-yellow" style="float:right;" onclick="window.location = '{{ URL::to('properties/item/'.$property->id) }}'">Back To Property</button><br>
		<div style="clear:both;"></div>
		</div>
		</div>
		<div style="clear:both;"></div>
  </div> 
    <div class="grid_7" style="padding-bottom:35px;">
    <h3 class="panel-title">Client Information</h3>
    <div style="clear:both;"></div>
    <div class="reservation-form">
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
				<label>TIN:</label>
				{{ Form::text('tin_number',$user->tin_number,array('placeholder' => '','class' => 'control-input','readonly' => true)) }}
			</div>
			<div style="clear:both;"></div>
		</div>
		<div class="reservation-holder">
			<div class="whole">
				<label>Home Address:</label>
				{{ Form::textarea('home_address',join(" ",json_decode($user->home_address)),array('placeholder' => 'Home Address','class' => 'control-input','readonly' => true)) }}
			</div>
		</div>
		<div class="reservation-holder">
			<div class="whole">
				<label>Work Address:</label>
				{{ Form::textarea('work_address',join(" ",json_decode($user->work_address)),array('placeholder' => 'Work Address','class' => 'control-input','readonly' => true)) }}
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
				<div class="half">
					<label>Block</label>
					{{ Form::select('block',$blocks,null,array('class' => 'control-input','id' => 'block-select')) }}
				</div>
				<div class="half">
					<label>Lot</label>
					{{ Form::select('lot',array('Select Lot'),null,array('class' => 'control-input','id' => 'lot-select')) }}
				</div>
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
				<textarea id="terms" style="width:100%; height:200px;" readonly>{{ strip_tags(Post::content(164)) }}</textarea>
				<div style="clear:both;"></div>
				<input type="checkbox" id="agree" value="true"/>I agree to the the terms and condition.
				<button type="submit" class="button-yellow" style="float:right; display:none;" id="reserve-button">Send Reservation</button><br>
		</div>
		<div style="clear:both;"></div>
    </div>
    <div style="clear:both;"></div>
  </div> 
  {{ Form::close() }}
@stop