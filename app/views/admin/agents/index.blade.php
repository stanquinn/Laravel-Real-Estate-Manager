@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Agents</h3>
                <input type="hidden" id="create_location" value="{{ URL::to('admin/agents/create') }}"/>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($agents as $agent)
                        <tr>
                          <td>{{ $agent->last_name }}, {{ $agent->first_name }}</td>
                          <td>{{ $agent->email }}</td>
                          <td>{{ $agent->phone }}</td>
                          <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              Manage Transaction
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                               <li><a href="{{ URL::to('admin/agents/'.$agent->id.'/edit') }}" >Update</a></li> 
                               <li><a href="{{ URL::to('admin/agents/'.$agent->id) }}" >View Profile</a></li>
                               <li><a href="{{ URL::to('admin/agents/commissions/'.$agent->id) }}" >Commissions</a></li>
                               <li><a href="{{ URL::to('admin/agents/delete/'.$agent->id) }}" onclick="if(window.confirm('Are you sure you want to delete this item?')){ return true;}else{return false;}">Delete</a></li>
                            </ul>
                          </div>
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
