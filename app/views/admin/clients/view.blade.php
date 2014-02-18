@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Client Account View <a class="add-button" href="{{ URL::to('admin/clients') }}">Back To Clients</a></h3>
            </div>
            <div class="panel-body">
                <table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse:collapse;">
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Client Name</td>
                    <td width="69%">{{ $client->first_name }} {{ $client->last_name }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Email</td>
                    <td width="69%">{{ $client->email }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Landline</td>
                    <td width="69%">{{ $client->landline }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Mobile</td>
                    <td width="69%">{{ $client->mobile }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Home Address</td>
                    <td width="69%">{{ join(" ",json_decode($client->home_address)) }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Work Address</td>
                    <td width="69%">{{ join(" ",json_decode($client->work_address))}}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Company</td>
                    <td width="69%">{{ $client->company }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Occupation</td>
                    <td width="69%">{{ $client->occupation }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">TIN Number</td>
                    <td width="69%">{{ $client->tin_number }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Registration Date</td>
                    <td width="69%">{{ $client->created_at->format("F j,Y") }}</td>
                  </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop


