@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-lg-5" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Developer</h3>
            </div>
            <div class="panel-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                    </div>
                    @endif
                    {{ Form::model($developer, array('method' => 'PATCH', 'route' => array('admin.developers.update', $developer->id))) }}                <div class="form-group">
                    <div class="form-group">
                    {{ Form::label('name', 'Name:') }}
                    {{ Form::text('name',null,array('class'=>'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('name', 'Email:') }}
                        {{ Form::email('email',null,array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                    {{ Form::submit('Update', array('class' => 'btn btn-info')) }}
                    {{ link_to_route('admin.developers.show', 'Cancel', $developer->id, array('class' => 'btn')) }}
                    </div>
                    {{ Form::close() }}
                    </div>
            </div>
        </div>
    </div>
</div>
@stop


