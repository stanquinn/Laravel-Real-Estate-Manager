@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">View Property</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                <div class="row" style="border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Property Name:') }}<br>
                        {{ $property->name }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Model Number:') }}<br>
                        {{ $property->model_number }}
                    </div>
                </div>
                <div class="row" style="border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group col-lg-12">
                        {{ Form::label('name', 'Description:') }}<br>
                        {{ $property->description }}
                    </div>
                </div>
                <div class="row" style="border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Agent:') }}<br>
                        {{ $property->agent }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Price:') }}<br>
                        {{ number_format($property->price,2) }}
                    </div>
                </div>
                <div class="row" style="border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Bedrooms:') }}<br>
                        {{ $property->beds }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Bathrooms:') }}<br>
                        {{ $property->baths }}
                    </div>
                </div>
                <div class="row" style="border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Floor Area:') }}<br>
                        {{ $property->floor_area }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Lot Area:') }}<br>
                        {{ $property->lot_area }}
                    </div>
                </div>
                <div class="row" style="border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group col-lg-12">
                        {{ Form::label('name', 'Google Map:') }}<br>
                        {{ $property->map }}
                    </div>
                </div>
                <div class="row" style="border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Block:') }}<br>
                        {{ $property->block }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Lot:') }}<br>
                        {{ $property->lot }}
                    </div>
                </div>
                <div class="row" style="border-bottom:solid 1px #ccc; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group col-lg-4">
                        {{ Form::label('name', 'Reservation Fee:') }}<br>
                        {{ number_format($property->reservation_fee,2) }}
                    </div>
                    <div class="form-group col-lg-4">
                        {{ Form::label('name', 'Status:') }}<br>
                        {{ $property->stats }}
                    </div>
                    <div class="form-group col-lg-4">
                        {{ Form::label('name', 'Location:') }}<br>
                        {{ Location::find($property->location_id)->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Property Type:') }}<br>
                        {{ Type::find($property->type_id)->name }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Developer:') }}<br>
                        {{ Developer::find($property->developer_id)->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        {{ Form::label('name', 'Computation:') }}<br>
                        <img src="{{ Property::get_computation($property->id,array(600,600)) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop