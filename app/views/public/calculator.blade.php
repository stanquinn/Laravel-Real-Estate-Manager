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
    <div style="margin:auto; width:400px;">
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
		    <td class="item-info-label">Loanable Amount</td>
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
  {{ Form::close() }}
@stop