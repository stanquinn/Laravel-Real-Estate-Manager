@extends('layouts.public')
@section('content')
    <div class="grid_8" id="left">
        <h3 class="panel-title"><?php echo ucwords($post->title);?></h3>
        <p class="post"><?php echo $post->content;?></p>
	    @if ($errors->any())
	    <div class="alert alert-danger">
	        <h4>Warning!</h4>
	        {{ implode('', $errors->all(':message</br>')) }}
	    </div>
	    @endif
		@if ($message = Session::get('success'))
		<div class="alert alert-success alert-dismissable">
		  <strong>Success:</strong> {{ $message }}
		</div>
		{{ Session::forget('success') }}
		@endif
        {{ Form::open() }}
        <div class="contact-form">
        	<div class="form-group">
        		{{ Form::label('Your Name') }}
        		{{ Form::text('name',null,array('class' => 'form-control'))}}
        	</div>
        	<div class="form-group">
        		{{ Form::label('Email') }}
        		{{ Form::text('email',null,array('class' => 'form-control'))}}
        	</div>
        	<div class="form-group">
        		{{ Form::label('Message') }}
        		{{ Form::textarea('message',null,array('class' => 'form-control'))}}
        	</div>
        	<div class="form-group">
        		<button type="submit" class="search-button button-yellow">Send Inquiry</button>
        	</div>
        </div>
        {{ Form::close() }}
    </div>
@include('layouts.sidebar')    
@stop