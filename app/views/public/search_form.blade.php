@extends('layouts.master')
@section('content')
<section class="content" style="min-height:700px;"> 
    <div id="advance_search">
        <form action="{{ URL::to('properties') }}" method="GET">
        <h3>Advance Search</h3> 
        <div class="control-holder">
            <label>Keyword:</label>
            <input type="text" name="s" value="" placeholder="Find Properties In The Philippines" id="keyword"/>
        </div>
        <div class="control-holder">
            <label>Location:</label>
            <select name='location' style="width:100%;">
                @foreach($locations as $l)
                    <option value="{{ $l->id }}">{{ ucwords($l->name) }}</option>
                @endforeach
            </select>
        </div> 
        <div class="control-holder">
            <label>Property Type:</label>
            <select name='type' style="width:100%;">
                @foreach($types as $l)
                    <option value="{{ $l->id }}">{{ ucwords($l->name) }}</option>
                @endforeach
            </select>
        </div>  
        <div class="submit-holder">
            <input type="submit" value="Search Properties" name="submit"/>
            <div class='clear'></div>
        </div>
    </form>
    </div>
    <a href="#top" class="go-top">Go to top of page</a>
</section>
@stop