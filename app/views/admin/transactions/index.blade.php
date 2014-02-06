@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Transaction History <a class="add-button" href="{{ URL::to('admin/clients/view/'.$user->id) }}">Back To Account</a></h3>
                <input type="hidden" id="create_location" value="{{ URL::route('admin.transactions.create') }}"/>
                <style type="text/css">.DTTT_button { display: none !important; }</style>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                    <tr>
                        <th>Reference Number</th>
                        <th>Model Number</th>
                        <th>Client Name</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->reference_number }}</td>
                        <td>{{ $transaction->property->model_number }}</td>
                        <td>{{ ucwords($transaction->user->first_name.' '.$transaction->user->last_name) }}</td>
                        <td>{{ date("F j,Y H:i",strtotime($transaction->created_at)) }}</td>
                        <td>{{ date("F j,Y H:i",strtotime($transaction->updated_at)) }}</td>
                        <td>{{ $transaction->status_text }}</td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                              Manage Transaction
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                               <li><a href="{{ URL::to('admin/transactions/'.$transaction->id.'/edit') }}" >Change Status</a></li>
                               <li><a href="{{ URL::to('admin/transactions') }}/invoice/{{ $transaction->id }}" >View Invoice</a></li>
                               <li><a href="{{ URL::to('admin/properties/') }}/{{ $transaction->property_id }}" >View Property</a></li>
                               <!--<li><a href="{{ URL::to('admin/transactions/'.$transaction->id.'/delete') }}" onclick="if(window.confirm('Are you sure you want to delet this item?')){ return true;}else{return false;}">Delete</a></li>-->
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
