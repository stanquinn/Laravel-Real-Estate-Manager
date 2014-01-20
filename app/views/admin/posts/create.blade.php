@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12" style="margin:auto; float:none;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Create Post</h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button data-dismiss="alert" class="close" type="button">&times;</button>
                    <h4>Warning!</h4>
                    {{ implode('', $errors->all(':message</br>')) }}
                </div>
                @endif
                {{ Form::open(array('route' => 'admin.posts.store','files'=>true)) }}
                <div class="row">
                    <div class="form-group col-lg-12">
                        {{ Form::label('title', 'Title:') }}
                        {{ Form::text('title',null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        {{ Form::textarea('content',null,array('class' => 'form-control richeditor')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4 pull-left">
                        <span class="btn btn-default btn-file" style="width:86%;">
                            Add Photo {{ Form::file('photo',array('accepts'=> '/*')) }}
                        </span>
                    </div>
                    <div class="form-group col-lg-4 pull-right">
                        {{ Form::label('name', 'Post Type:') }}
                        {{ Form::select('post_type', array('page' => 'Page', 'news' => 'News'),null,array('class' => 'form-control')) }}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-12">
                        {{ Form::submit('Submit', array('class' => 'btn btn-info btn-large pull-right')) }}
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop