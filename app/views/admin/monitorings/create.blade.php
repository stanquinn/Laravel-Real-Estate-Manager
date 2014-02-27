@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-5" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create Block and Lot for {{ $property->name }}</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                    {{ Form::open() }}
                    <div class="form-group">
                        {{ Form::label('block', 'Block:') }}
                        {{ Form::text('block',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('lot', 'Lot:') }}
                        {{ Form::text('lot',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('status', 'Status:') }}
                        {{ Form::select('status', array('available' => 'Available', 'unavailable' => 'Unavailable'),null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
                        <a class="btn btn-danger" href="{{ URL::to('admin/monitorings/'.$property->id) }}">Back To List</a>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
