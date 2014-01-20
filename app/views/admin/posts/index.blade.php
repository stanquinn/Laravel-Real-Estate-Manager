@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">All Locations</h3>
                <input type="hidden" id="create_location" value="{{ URL::route('admin.posts.create') }}"/>
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
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{{ ucwords($post->title) }}}</td>
                        <td>
                            {{ link_to_route('admin.posts.edit', 'Edit', array($post->id), array('class' => 'btntable DTTT_button pull-left')) }}
                            {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.posts.destroy', $post->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btntable DTTT_button pull-left btn-delete')) }}
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
