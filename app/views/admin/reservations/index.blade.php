@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Reservations <a class="add-button" href="{{ URL::to('admin/reservations/create') }}">Add Reservation</a></h3>
                <input type="hidden" id="create_location" value="{{ URL::route('admin.reservations.create') }}"/>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Property(Model Number)</th>
                            <th>Client Name</th>
                            <th>Terms</th>
                            <th>Unit Type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->property->model_number }}</td>
                            <td>{{ $p->firstname }} {{ $p->lastname }}</td>
                            <td>{{ $p->terms }}</td>
                            <td>{{ $p->unit_type }}</td>
                            <td>
                                <a href="{{ URL::to('admin/reservations/'.$p->id.'/edit') }}" class="btntable DTTT_button pull-left">Edit</a>
                                <a href="{{ URL::to('admin/reservations/delete/'.$p->id) }}" class="btntable btn-delete DTTT_button pull-left">Delete</a>
                                <a href="{{ URL::to('admin/reservations') }}/{{ $p->id }}" class="btntable DTTT_button pull-left">View</a>
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
