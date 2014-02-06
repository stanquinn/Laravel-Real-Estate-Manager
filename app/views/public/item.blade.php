@extends('layouts.public')
@section('content')
    <div class="grid_8" id="left">
        <h3 class="panel-title">{{ $property->name }}</h3>
        <div class="item">
            <div class="item-main-image half">
                <img src="{{ Property::primary_photo($property->id,array(291,190)) }}"/>
                <button type="submit" class="search-button button-yellow reserve" onclick="window.location = '{{ URL::to('clients/reserve/'.$property->id) }}'">Reserve This Property</button>
            </div>
            <div class="item-info half last">
                <table class="item-info-table">
                    <tr>
                        <td class="item-info-label">Price</td>
                        <td>&#8369;{{ number_format($property->price,2) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Reservation Fee</td>
                        <td>&#8369;{{ number_format($property->reservation_fee,2) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Location</td>
                        <td>{{ ucwords($property->location->name) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Beds</td>
                        <td>{{ $property->beds }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Baths</td>
                        <td>{{ $property->baths }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Lot Area</td>
                        <td>{{ $property->lot_area }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Floor Area</td>
                        <td>{{ $property->floor_area }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Developer</td>
                        <td>{{ ucwords($property->developer->name) }}</td>
                    </tr>
                    <tr>
                        <td class="item-info-label">Type</td>
                        <td>{{ ucwords($property->type->name ) }}</td>
                    </tr>
                </table>
            </div> 
            <div class="clear"></div>
        </div>
        <h3 class="panel-title">Description</h3>
        <div class="item" style="min-height:300px;">{{ $property->description }}</div>
        @if(!empty($gallery))
        <h3 class="panel-title">Images</h3>
        <ul class="item-images">
            @foreach($gallery as $photo)
            <?php $full = preg_replace('/http:[\/][\/]realestate.dev:90[\/]photos[\/]timthumb.php[?]src=/','',$photo['fullsize']);?>
            <?php $full = preg_replace('/[&](.*)/', '', $full);?>
            <li><a class="fancybox" data-fancybox-group="gallery" href="{{ $full }}"><img src="{{ $photo['thumbnail'] }}" alt=""></a></li>
            @endforeach
        </ul>
        @endif
    </div>
@include('layouts.sidebar')    
@stop