@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-12" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Show Developer</h3>
            </div>
            <div class="panel-body">
                <p>{{ link_to_route('admin.developers.index', 'Return to all developers') }}</p>

                <table class="table table-striped table-bordered" id="xdatatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{{ $developer->name }}}</td>
                            <td>
                                {{ link_to_route('admin.developers.edit', 'Edit', array($developer->id), array('class' => 'btntable DTTT_button pull-left')) }}
                                {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.developers.destroy', $developer->id))) }}
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
