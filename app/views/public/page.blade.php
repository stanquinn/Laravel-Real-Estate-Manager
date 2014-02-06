@extends('layouts.public')
@section('content')
    <div class="grid_8" id="left">
        <h3 class="panel-title"><?php echo ucwords($post->title);?></h3>
        <div class="post"><?php echo $post->content;?></div>
    </div>
@include('layouts.sidebar')    
@stop