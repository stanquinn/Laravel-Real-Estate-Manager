@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Agent Account View</h3>
            </div>
            <div class="panel-body">
                <table width="100%" border="1" cellspacing="0" cellpadding="10" style="border-collapse:collapse;">
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Agent Name</td>
                    <td width="69%">{{ $agent->first_name }} {{ $agent->last_name }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Email</td>
                    <td width="69%">{{ $agent->email }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Landline</td>
                    <td width="69%">{{ $agent->phone }}</td>
                  </tr>
                  <tr>
                    <td style="background-color:#333; color:white; width:30%;">Created Date</td>
                    <td width="69%">{{ $agent->created_at->format("F j,Y") }}</td>
                  </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@stop


