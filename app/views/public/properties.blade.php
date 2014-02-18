@extends('layouts.public')
@section('content')
    <div class="grid_8" id="left">
@if(!$properties->isEmpty())
    @if(Input::get('search'))
        <h3 class="panel-title">Property Search</h3>
        <script type="text/javascript">
            $(document).ready(function(){
                $.notify("Found {{ $properties->count() }} results.", "success");
            });
        </script>
    @else
        <h3 class="panel-title">All Properties</h3>
    @endif
        <ul class="item-list">
            @foreach($properties as $p)
            <li>
                <img src="{{ Property::primary_photo($p->id,array(100,100)) }}" class="item-thumb">
                <h4 class="property-title"><a href="{{ $p->permalink }}"><?php echo ucwords($p->name);?></a> <span class="property-price"> - &#8369;<?php echo number_format($p->price,2);?></span></h4>
                <p class="property-meta">Location: {{ ucwords($p->location->name) }} | Beds: {{ $p->beds }} | Baths: {{ $p->baths }} </p>
                <p class="property-excerpt">{{ Str::limit(strip_tags($p->description),257)}}</p>
                <a class="property-link" href="{{ $p->permalink }}">View Property</a>
                <div style="clear:both;"></div>
            </li>
            @endforeach
        </ul>
@else
    <h3 class="panel-title">No Results</h3>
    <script type="text/javascript">
        $(document).ready(function(){
            $.notify("No results was found with given parameters.", "error");
        });
    </script>
@endif
        {{ $properties->appends($appends)->links() }}
    </div>
@include('layouts.sidebar')    
@stop