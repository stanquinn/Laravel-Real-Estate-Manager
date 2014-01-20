@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Type</h3>
                <input type="hidden" id="create_location" value="{{ URL::route('admin.types.create') }}"/>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                    <tr>
                        <th width="30%">Name</th>
                        <th width="20%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($types as $type)
                    <tr>
                        <td>{{{ ucwords($type->name) }}}</td>
                        <td>
                            {{ link_to_route('admin.types.edit', 'Edit', array($type->id), array('class' => 'btntable DTTT_button pull-left')) }}
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.types.destroy', $type->id))) }}
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
