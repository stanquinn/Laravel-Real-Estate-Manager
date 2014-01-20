@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-5" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create Property Type</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                {{ Form::open(array('route' => 'admin.types.store')) }}
                <div class="form-group">
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name',null,array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop


