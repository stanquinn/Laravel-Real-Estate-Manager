@extends('layouts.master')
@section('content')
<section class="content">
    <article class="main">
        <h1><?php echo ucwords($article->title);?></h1>
        <?php echo $article->content;?>
    </article>
    @include('public.sidebar')
    <a href="#top" class="go-top">Go to top of page</a>
</section>
@stop