@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create Property</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                {{ Form::model($property, array('method' => 'PATCH', 'route' => array('admin.properties.update', $property->id))) }}
                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Property Name:') }}
                        {{ Form::text('name',$property->name,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Model Number:') }}
                        {{ Form::text('model_number',null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        {{ Form::label('name', 'Description:') }}
                        {{ Form::textarea('description',null,array('class' => 'form-control richeditor')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Equity:') }}
                        {{ Form::text('equity',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Price:') }}
                        {{ Form::text('price',null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Bedrooms:') }}
                        {{ Form::text('beds',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Bathrooms:') }}
                        {{ Form::text('baths',null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Floor Area:') }}
                        {{ Form::text('floor_area',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Lot Area:') }}
                        {{ Form::text('lot_area',null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        {{ Form::label('name', 'Google Map:') }}
                        {{ Form::textarea('map',null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Block:') }}
                        {{ Form::text('block',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Lot:') }}
                        {{ Form::text('lot',null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4">
                        {{ Form::label('name', 'Reservation Fee:') }}
                        {{ Form::text('reservation_fee',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-4">
                        {{ Form::label('name', 'Status:') }}
                        {{ Form::select('status', array('0' => 'Inactive', '1' => 'Active'),null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-4">
                        {{ Form::label('name', 'Location:') }}
                        {{ Form::select('location_id',Location::dropdown(),null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Property Type:') }}
                        {{ Form::select('type_id',Type::dropdown(),null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group col-lg-6">
                        {{ Form::label('name', 'Developer:') }}
                        {{ Form::select('developer_id',Developer::dropdown(),null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        {{ Form::submit('Submit', array('class' => 'btn btn-info btn-large pull-right')) }}
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop