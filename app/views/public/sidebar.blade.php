<aside>
    <section>
        @if(isset($reservation_button))
            <a class="reservation-button" href="{{ URL::to('properties/reserve/'.$reservation_button) }}">Reserve This Property</a>
        @endif
    </section>
    <section>
        <h3><span>Locations</span></h3>
        <ul>
            <?php foreach($locations as $l):?>
                <li><a href="{{ URL::to('properties?location='.$l->id) }}"><?php echo ucwords($l->name);?></a> ({{ $l->properties->count()}})</li>
            <?php endforeach;?>
        </ul>
    </section>

    <section>
        <div class="tabbed">
            <ul class="tabs">
                <li><a href="#popular">Latest News</a></li>
            </ul>
            <div class="tab-content" id="popular">
                <ul class="posts">
                    <?php foreach($news as $n):?>
                        <li>
                            <a href="{{ URL::to('article/'.$n->id) }}"><img src="<?php echo Post::get_image($n->id,array(50,50));?>" alt="<?php echo $n->title;?>"></a>
                            <a href="{{ URL::to('article/'.$n->id) }}"><?php echo ucwords($n->title);?></a>
                            <span>{{ date("F j,Y H:i A",strtotime($n->created_at)) }} by Admin</span>
                        </li>
                    <?php endforeach;?>
            </div>
        </div>
    </section>
</aside>