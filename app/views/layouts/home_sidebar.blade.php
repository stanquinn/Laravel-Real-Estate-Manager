            <div class="grid_4" id="right">
                <h3 class="panel-title">Welcome To Live and Love</h3>
                <div class="widget-inner">
                    <p>This is where everything I like belongs.Where I always find people I love.This is where I feel safe. This is where I can laugh loud and run fast. This is where I dreams with the moon, and daydream when the sunshines. This is where I discover new things and invent stories I tell.This is where my friends play, and my toys wake up. This is a place I love. This is where I live.</p>
                </div>
                <h3 class="panel-title">Steps in Reserving Property </h3>
                <div class="widget-inner">
<p>
  1. Select property.<br />
  2.  Create an account. (An email activation will be sent to the email account)<br />
  3.  Activate your account.<br />
  4.  Login your account. <br />
  5. Fill up Reservation Form.<br />
  6.  MUST read The Terms and Condition. <br />
  7. Click the reserve button (A summary of  transaction will be sent to your email account)</p>
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
                        Office | 667-3511 to 12<br>
                        info@liveandlove.com<br>
                        736 Cityland Mega Plaza, ADB Ave., Ortigas Center, Pasig City</p>
                </div>
            </div>