@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Developers</h3>
                <input type="hidden" id="create_location" value="{{ URL::route('admin.developers.create') }}"/>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                    <tr>
                        <th width="30%">Name</th>
                        <th width="30%">Email</th>
                        <th width="20%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($developers as $developer)
                       <tr>
                           <td>{{{ ucwords($developer->name) }}}</td>
                           <td>{{{ $developer->email }}}</td>
                           <td>
                               {{ link_to_route('admin.developers.edit', 'Edit', array($developer->id), array('class' => 'btntable DTTT_button pull-left')) }}
                               {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.developers.destroy', $developer->id))) }}
                               {{ Form::submit('Delete', array('class' => 'btn-delete btntable DTTT_button pull-left')) }}
                               {{ Form::close() }}
                           </td>
                       </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
