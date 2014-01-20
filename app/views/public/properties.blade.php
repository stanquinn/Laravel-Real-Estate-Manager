@extends('layouts.master')
@section('content')
<section class="content">
	<h3>Available Properties <span class="advance-search-link"></a></h3> 
	<div style="clear:both;"></div>
	<section class="columns">
		@foreach($properties as $p)                  
		<article class="property_column post">
			<div style="padding:10px; border: 1px solid #ccc; text-align:center;">
				<a href="{{ $p->permalink }}"><img src="{{ Property::primary_photo($p->id,array(232,150)) }}"/></a>
				<div style="padding-top:10px;">
					<a href="{{ $p->permalink }}"><h4 class="property_title">{{ ucwords($p->name) }}</h4></a>
					<span class="property_price">&#8369;{{ number_format($p->price,2) }}</span><br>
					<span class="property_location"><strong>Location:</strong> {{ ucwords($p->location->name) }}</span>
				</div>
			</div>
	    </article>  
	    @endforeach
	</section>
	<div class="custom_pagination">{{ $properties->links() }}</div>
<a href="#top" class="go-top">Go to top of page</a>
</section>
@stop