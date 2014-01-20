@extends('layouts.master')
@section('content')
<section class="content">
<section class="main postlist">
	<div class="property_item">
		<h3 class="property_name">{{ $property->name }}</h3>
		<div style="clear:both;"></div>
		<div class="property_img">
			<img src="{{ Property::primary_photo($property->id,array(232,198)) }}"/>
		</div>
		<div class="property_meta">
			<ul>
				<li>Price: <span class="property_price">&#8369;{{ number_format($property->price,2) }}</span></li>
				<li>Reservation Fee: <span class="property_price">&#8369;{{ number_format($property->reservation_fee,2) }}</span></li>
				<li>Location: <span class="property_location">{{ ucwords($property->location->name) }}</span></li>
				<li>Beds: {{ $property->beds }}</li>
				<li>Baths: {{ $property->baths }}</li>
				<li>Lot Area: {{ $property->lot_area }}</li>
				<li>Floor Area: {{ $property->floor_area }}</li>
				<li>Developer: {{ ucwords($property->developer->name) }}</li>
				<li>Type: {{ ucwords($property->type->name ) }}</li>
				@if(Sentry::check())
	  				@if (Sentry::getUser()->isSuperUser())
						<li><a href="{{ URL::to('admin/properties/'.$property->id.'/edit') }}">Edit Property</a></li>
	  				@endif
  				@endif
			</ul>
		</div>
		<div style="clear:both;"></div>
	</div>
    <div style="clear:both;"></div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <h4>Warning!</h4>
        {{ implode('', $errors->all(':message</br>')) }}
    </div>
    @endif
	@if ($message = Session::get('success'))
	<div class="alert alert-success alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <strong>Success:</strong> {{ $message }}
	</div>
	{{ Session::forget('success') }}
	@endif
	<div id="tab-container" class="tab-container">
	  <ul class='etabs'>
	    <li class='tab'><a href="#tabs1-html">Description</a></li>
	    <li class='tab'><a href="#tabs1-js">Images</a></li>
	    <li class='tab'><a href="#tabs1-css">Inquire</a></li>
	    <li class='tab'><a href="#tabs1-computation">Computation</a></li>
	  </ul>
	  <div id="tabs1-html">
	    <h2 class="item_heading">Description</h2>
	    <!-- content -->
	    {{ $property->description }}
	  </div>
	  <div id="tabs1-js">
	    <!-- content -->
	    	@foreach($gallery as $photo)
			<a href="{{ $photo['fullsize'] }}" class="action view"><img src="{{ $photo['thumbnail'] }}" alt=""></a>
	    	@endforeach
	  </div>
	  <div id="tabs1-css">
	    <!-- content -->
	    	{{ Form::open() }}
	    		<div class="inquire-control-holder">
	    			{{ Form::text('name',null,array('class' => 'inquire-form-text','placeholder' => 'Your name'))}}
	    		</div>
	    		<div class="inquire-control-holder">
	    			{{ Form::email('email',null,array('class' => 'inquire-form-text','placeholder' => 'Email Address'))}}
	    		</div>
	    		<div class="inquire-control-holder">
	    			{{ Form::text('phone',null,array('class' => 'inquire-form-text','placeholder' => 'Mobile or Landline'))}}
	    		</div>
	    		<div class="inquire-control-holder">
	    			{{ Form::textarea('message',null,array('class' => 'inquire-form-text','placeholder' => 'Your Message'))}}
	    		</div>
	    		<div class="inquire-control-holder">
	    			{{ Form::submit('Send Inquiry')}}
	    		</div>
	    	{{ Form::close() }}
	  </div>
	  <div id="tabs1-computation">
	    <!-- content -->
	    <img src="{{ Property::get_computation($property->id,array(600,600)) }}" style="max-width:100%;"/>
	  </div>
	</div>

</section>
@include('public.sidebar')
<a href="#top" class="go-top">Go to top of page</a>
</section>
@stop