@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Report</h3>
              <style type="text/css">.DTTT_button { display: none !important; }</style>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="x2datatable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Developer</th>
                            <th>Agent</th>
                            <th>Property(Model Number)</th>
                            <th>Client Name</th>
                            <th>Mobile</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->created_at->format("j F Y") }}</td>
                            <td>
                                @if(is_object($p->property))
                                {{ $p->property->location->name }}
                                @endif
                            </td>
                            <td>
                                @if(is_object($p->property))
                                {{ $p->property->developer->name }}
                                @endif
                            </td>
                            <td>
                                @if(is_object($p->agent))
                                {{ $p->agent->first_name }} {{ $p->agent->last_name }}
                                @endif
                            </td>
                            <td>
                                @if(is_object($p->property))
                                {{ $p->property->model_number }}
                                @endif
                            </td>
                            <td>
                                @if(is_object($p->user))
                                {{ $p->user->first_name }} {{ $p->user->last_name }}
                                @endif
                            </td>
                            <td>
                                @if(is_object($p->user))
                                {{ $p->user->mobile }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL::to('admin/clients/reservation') }}/{{ $p->id }}" class="btntable pull-left">View Information</a>
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
