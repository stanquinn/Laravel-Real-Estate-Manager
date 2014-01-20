@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Show Property Type</h3>
            </div>
            <div class="panel-body">
                <p>{{ link_to_route('admin.types.index', 'Return to all types') }}</p>

                <table class="table table-striped table-bordered" id="xdatatable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>{{{ $type->name }}}</td>
                        <td>
                            {{ link_to_route('admin.types.edit', 'Edit', array($type->id), array('class' => 'btntable DTTT_button pull-left')) }}
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.types.destroy', $type->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btntable DTTT_button pull-left')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
