            <div class="grid_4" id="right">
                <h3 class="panel-title">Welcome To Live and Love</h3>
                <div class="widget-inner">
                    <p>Four Seasons Sotheby's International Realty in Meredith serves the entire Lakes Region of New Hampshire including Lake Winnipesaukee, Squam Lake and Newfound Lake. Four Seasons SIR offers extraordinary expertise and extensive marketing to both buyers and sellers. Whether you are looking for a unique waterfront home, Squam Lake Adirondack compound or mountain top estate, Four Seasons Sotheby's can assist in your property search. Associates Ruth and Brian Neidhardt have been Realtors.</p>
                </div>
                <h3 class="panel-title">Latest News</h3>
                <ul class="news-list">
                    @foreach($news as $n)
                    <li>
                        <a href="{{ URL::to('article/'.$n->id) }}"><img src="<?php echo Post::get_image($n->id,array(50,50));?>" alt="<?php echo $n->title;?>"></a>
                        <p class="news-title"><a href="{{ URL::to('article/'.$n->id) }}"><?php echo ucwords($n->title);?></a></p>
                        <p>{{ Str::limit(strip_tags($n->content),100)}}</p>
                    </li>
                    @endforeach
                </ul>
                <h3 class="panel-title">Contact Us</h3>
                <div class="widget-inner">
                    <p><strong>Live and Love Realty Corporation</strong><br>
                        Office | 603.677.7012<br>
                        info@liveandlove.com<br>
                        Meredith Office 3 Main Street Pasig City 1607, Philippines</p>
                </div>
            </div>