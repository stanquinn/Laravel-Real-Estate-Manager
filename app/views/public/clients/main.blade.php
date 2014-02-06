@extends('layouts.public')
@section('content')
    <div class="grid_8" id="left">
        <h3 class="panel-title">My Reservations</h3>
        <div class="reservations" style="padding-top:10px;">
			@include('layouts.notifications')
        	<table class="striped">
        		<tr>
        			<th>Model Number</th>
        			<th>Agent Name</th>
        			<th>Date</th>
        			<th></th>
        		<tr>
        		@foreach($reservations as $reservation)
        		<tr>
        			<td>{{ $reservation->property->model_number }}</td>
        			<td>{{ $reservation->agent->first_name }} {{ $reservation->agent->last_name }}</td>
        			<td>{{ $reservation->created_at->format("F j,Y") }}</td>
        			<td>
        				<a href="{{ URL::to('clients/reservation/'.$reservation->id) }}">More Info</a>
        			</td>
        		<tr>	
        		@endforeach
        	</table>
        	{{ $reservations->links() }}
        </div>
        <div class="clear"></div><br><br>
        <h3 class="panel-title">My Transactions</h3>
        <div class="reservations" style="padding-top:10px;">
        	<table class="striped">
        		<tr>
        			<th>Reference No.</th>
        			<th>Model No</th>
        			<th>Amount</th>
        			<th>Status</th>
        			<th>Date</th>
        			<th></th>
        		<tr>
        		@foreach($transactions as $transaction)
        		<tr>
        			<td>{{ $transaction->reference_number }}</td>
        			<td>{{ $transaction->property->model_number }}</td>
        			<td>{{ number_format($transaction->amount,2) }}</td>
        			<td>{{ $transaction->status_text }}</td>
        			<td>{{ $transaction->created_at->format("F j,Y") }}</td>
        			<td>
        				<a href="{{ URL::to('clients/invoice/'.$transaction->id) }}">View Invoice</a>
        			</td>
        		<tr>	
        		@endforeach
        	</table>
        	{{ $reservations->links() }}
        </div>
    </div>
@include('layouts.sidebar')    
@stop