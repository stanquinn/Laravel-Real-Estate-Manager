@extends('layouts.master')
@section('content')
<section class="content">
    <article class="main">
        <h1><?php echo ucwords($a->title);?></h1>
        <?php echo $a->content;?>
    </article>
    @include('public.sidebar')
    <a href="#top" class="go-top">Go to top of page</a>
</section>
@stop