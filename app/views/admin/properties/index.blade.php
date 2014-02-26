@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Type</h3>
                <input type="hidden" id="create_location" value="{{ URL::route('admin.properties.create') }}"/>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Model#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($properties as $property)
                    <tr>
                        <td>
                            <img src="{{ Property::primary_photo($property->id) }}">
                        </td>
                        <td>{{ $property->model_number }}</td>
                        <td>{{ ucwords($property->name) }}</td>
                        <td>{{ number_format($property->price,2) }}</td>
                        <td>{{ $property->stats }}</td>
                        <td>
                            <a href="{{ URL::to('admin/properties/'.$property->id.'/photos') }}" class="btntable DTTT_button pull-left">Photos</a>
                            <!--<a href="{{ URL::to('admin/properties/'.$property->id.'/computation') }}" class="btntable DTTT_button pull-left">Computation</a>-->
                            <a href="{{ URL::to('admin/properties/'.$property->id.'/edit') }}" class="btntable DTTT_button pull-left">Edit</a>
                            <a href="{{ URL::to('admin/monitorings/'.$property->id) }}" class="btntable DTTT_button pull-left">Monitoring</a>
                            <a href="{{ URL::to('admin/properties/'.$property->id.'/delete') }}" class="btntable btn-delete DTTT_button pull-left">Delete</a>
                            <a href="{{ URL::to('admin/properties') }}/{{ $property->id }}" class="btntable DTTT_button pull-left">View</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
