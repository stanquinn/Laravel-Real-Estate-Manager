@extends('layouts.master')
@section('content')
<section class="slider10">
    <a href="#" class="prev">Previous</a>
    <a href="#" class="next">Next</a>
    <ul>
        <?php foreach($sliders as $slider):?>
            <li><a href="<?php echo $slider->permalink;?>"><span class="img-border"><img src="{{ Property::primary_photo($slider->id,array(300,300)) }}" alt=""></span></a></li>
        <?php endforeach;?>
    </ul>
</section>
<section class="content reverse">
    <section class="main">
        <section class="hp-latest2">
            <article>
                <h3>Welcome To Our Homepage</h3>
                {{ Post::content(6) }}
            </article>
        </section>
        <section class="product-list-full">
            <h2><span>Latest Properties</span></h2>
            <ul>
               @foreach($properties as $p)
                    <li>
                        <div class="img"><img src="{{ Property::primary_photo($p->id,array(100,100)) }}"></div>
                        <h3><a href="{{ $p->permalink }}"><?php echo ucwords($p->name);?></a></h3>
                        <dl class="product-data">
                            <dt>Price:</dt>
                            <dd><a href="#">&#8369;<?php echo number_format($p->price,2);?></a></dd>
                            <dt>Beds:</dt>
                            <dd><a href="#"><?php echo $p->beds;?></a></dd>
                            <dt>Baths:</dt>
                            <dd><a href="#"><?php echo $p->baths;?></a></dd>
                            <dt>Location:</dt>
                            <dd><a href="{{ URL::to('search?location_id='.$p->location->id) }}"><?php echo ucwords($p->location->name);?></a></dd>
                        </dl>
                        <p>{{ Str::limit(strip_tags($p->description),257)}}</p>
                    </li>
              @endforeach
            </ul>
        </section>
    </section>
    @include('public.sidebar')
    <a href="#top" class="go-top">Go to top of page</a>
</section>
@stop