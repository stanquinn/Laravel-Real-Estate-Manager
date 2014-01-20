@extends('layouts.master')
@section('content')
<section class="content">
<section class="main postlist">
	@foreach($archives as $p)
	<article class="post">
		<h2><a href="{{ $p->permalink }}">{{ $p->title }}</a></h2>
		<p class="post-meta">{{ $p->post_date}} <span>|</span> by <a href="#" class="author">Admin</a> <span></p>
		<div class="img medium"><a href="{{ $p->permalink}}"><span class="img-border"><img src="{{ Post::get_image($p->id,array(300,160)) }}" alt=""></span></a></div>
		<p>{{ $p->excerpt }}</p>
		<p class="more"><a href="{{ $p->permalink }}">Read more</a></p>
	</article>
	@endforeach
	<div class="custom_pagination">{{ $archives->links() }}</div>
</section>
@include('public.sidebar')
<a href="#top" class="go-top">Go to top of page</a>
</section>
@stop