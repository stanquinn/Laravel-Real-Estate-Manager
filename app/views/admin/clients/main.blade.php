@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Clients</h3>
                <input type="hidden" id="create_location" value="{{ URL::to('admin/clients/create') }}"/>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>TIN</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($clients as $client)
                        @if(!Sentry::getUserProvider()->findById($client->id)->isSuperUser())
                        <tr>
                          <td>{{ $client->last_name }}, {{ $client->first_name }}</td>
                          <td>{{ $client->email }}</td>
                          <td>{{ $client->tin_number }}</td>
                          <td>{{ $client->mobile }}</td>
                          <td>{{ $client->status }}
                          <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              Manage Account
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                               <li><a href="{{ URL::to('admin/clients/update/'.$client->id) }}" >Update</a></li>
                               <li><a href="{{ URL::to('admin/clients/transactions/'.$client->id) }}" >Transactions</a></li>
                               <li><a href="{{ URL::to('admin/clients/reservations/'.$client->id) }}" >Reservations</a></li>  
                               <li><a href="{{ URL::to('admin/clients/view/'.$client->id) }}" >View Profile</a></li>
                               <li><a href="{{ URL::to('admin/clients/suspend/'.$client->id) }}" onclick="if(window.confirm('Are you sure you want to suspend this client?')){ return true;}else{return false;}">Change Status</a></li>
                               <li><a href="{{ URL::to('admin/clients/delete/'.$client->id) }}" onclick="if(window.confirm('Are you sure you want to delete this item?')){ return true;}else{return false;}">Delete</a></li>
                            </ul>
                          </div>
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
