@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Reservation Information <a class="add-button" href="{{ URL::to('admin/reservations/create') }}">Add Reservation</a></h3>
            </div>
            <div class="panel-body">
                <table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse:collapse;">
              <tr>
                <td width="31%">Model Number</td>
                <td width="69%">{{ $property->model_number }}</td>
              </tr>
              <tr>
                <td>Model Name</td>
                <td>{{ $property->name }}</td>
              </tr>
              <tr>
                <td>Client Name</td>
                <td>{{ $reservation->firstname }} {{ $reservation->lastname }}</td>
              </tr>
              <tr>
                <td>Landline</td>
                <td>{{ $reservation->phone }}</td>
              </tr>
              <tr>
                <td>Mobile</td>
                <td>{{ $reservation->mobile }}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{ $reservation->email }}</td>
              </tr>
              <tr>
                <td>Home Address</td>
                <td>{{ $reservation->home_address }}</td>
              </tr>
              <tr>
                <td>Work Address</td>
                <td>{{ $reservation->work_address }}</td>
              </tr>
              <tr>
                <td>TIN Number</td>
                <td>{{ $reservation->tin_number }}</td>
              </tr>
              <tr>
                <td>Company</td>
                <td>{{ $reservation->firstname }}</td>
              </tr>
              <tr>
                <td>Nature of Work</td>
                <td>{{ $reservation->company }}</td>
              </tr>
              <tr>
                <td>Terms</td>
                <td>{{ $reservation->terms }}</td>
              </tr>
              <tr>
                <td>Unit Type</td>
                <td>{{ $reservation->unit_type }}</td>
              </tr>
            </table>
              <div style="clear:both;"></div>
            </div>
        </div>
    </div>
</div>
@stop
