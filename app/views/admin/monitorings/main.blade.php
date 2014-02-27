@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Monitoring For {{ $property->name }}</h3>
                <input type="hidden" id="create_location" value="{{ URL::to('admin/monitorings/'.$property->id.'/create') }}"/>
            </div>
            <div class="panel-body">
                <div style="text-align:right;">
                  <p><strong>Total Slots:</strong> {{ $monitorings->count() }}</p>
                    <p><strong>Total Available:</strong> {{ $total_available }}</p>
                    <p><strong>Total Reserved/Unavailable:</strong> {{ $total_unavailable }}</p>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                    <tr>
                        <th width="30%">Block</th>
                        <th width="30%">Lot</th>
                        <th>Status</th>
                        <th width="20%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($monitorings as $monitoring)
                       <tr>
                           <td>{{{ ucwords($monitoring->block) }}}</td>
                           <td>{{{ $monitoring->lot }}}</td>
                           <td>{{{ $monitoring->status }}}
                           <td>
                              <a href="{{ URL::to('admin/monitorings/'.$monitoring->property_id.'/'.$monitoring->id.'/update') }}" class="btntable DTTT_button pull-left">Edit</a>
                              <a href="{{ URL::to('admin/monitorings/'.$monitoring->id.'/delete') }}" class="btntable DTTT_button pull-left">Delete</a>
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
