            <div class="grid_4" id="right">
                <h3 class="panel-title">Find Properties</h3>
                <div class="widget-inner search-widget">
                    {{ Form::open(array('url' => URL::to('properties'),'method' => 'GET')) }}
                    <div class="form-group">
                        {{ Form::label('Location') }}
                        {{ Form::select('location',Location::dropdown(true),null,array('class' => 'search-select','id' => 'location')) }}
                        <input type="hidden" name="search" value="true">
                    </div>
                    <div class="form-group">
                        {{ Form::label('Type') }}
                        {{ Form::select('type',Type::dropdown(true),null,array('class' => 'search-select','id' => 'type')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Developer') }}
                        {{ Form::select('developer',Developer::dropdown(true),null,array('class' => 'search-select','id' => 'developer-dropdown')) }}
                    </div>
                    <div class="form-group">
                        <div class="form-half">
                            {{ Form::label('Beds') }}
                           <select name="beds" class="search-select">
                                <option value="">Any Number</option>
                                <option value="0">Studio</option>
                                <option value="1">1+</option>
                                <option value="2">2+</option>
                                <option value="3">3+</option>
                                <option value="4">4+</option>
                                <option value="5">5+</option>
                                <option value="6">6+</option>
                                <option value="7">7+</option>
                                <option value="8">8+</option>
                                <option value="9">9+</option>
                                <option value="10">10+</option>
                            </select>
                        </div>
                        <div class="form-half last">
                            {{ Form::label('Baths') }}
                           <select name="baths" class="search-select">
                                <option value="">Any Number</option>
                                <option value="1">1+</option>
                                <option value="2">2+</option>
                                <option value="3">3+</option>
                                <option value="4">4+</option>
                                <option value="5">5+</option>
                                <option value="6">6+</option>
                                <option value="7">7+</option>
                                <option value="8">8+</option>
                                <option value="9">9+</option>
                                <option value="10">10+</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-group">
                        <div class="form-half">
                            {{ Form::label('Min Price') }}
                            <select name="min" class="search-select">
                                <option value="0">Min Price</option>
                                <option value="500000">500,000</option>
                                <option value="550000">550,000</option>
                                <option value="600000">600,000</option>
                                <option value="650000">650,000</option>
                                <option value="700000">700,000</option>
                                <option value="750000">750,000</option>
                                <option value="800000">800,000</option>
                                <option value="850000">850,000</option>
                                <option value="900000">900,000</option>
                                <option value="950000">950,000</option>
                                <option value="1000000">1 million</option>
                                <option value="1500000">1.5 million</option>
                                <option value="2000000">2 million</option>
                                <option value="2500000">2.5 million</option>
                                <option value="3000000">3 million</option>
                                <option value="3500000">3.5 million</option>
                                <option value="4000000">4 million</option>
                                <option value="4500000">4.5 million</option>            
                                <option value="5000000">5 million</option>
                                <option value="10000000">10 million</option>
                            </select>
                        </div>
                        <div class="form-half last">
                            {{ Form::label('Max Price') }}
                            <select name="max" class="search-select">
                                <option value="0">Max Price</option>
                                <option value="500000">500,000</option>
                                <option value="550000">550,000</option>
                                <option value="600000">600,000</option>
                                <option value="650000">650,000</option>
                                <option value="700000">700,000</option>
                                <option value="750000">750,000</option>
                                <option value="800000">800,000</option>
                                <option value="850000">850,000</option>
                                <option value="900000">900,000</option>
                                <option value="950000">950,000</option>
                                <option value="1000000">1 million</option>
                                <option value="1500000">1.5 million</option>
                                <option value="2000000">2 million</option>
                                <option value="2500000">2.5 million</option>
                                <option value="3000000">3 million</option>
                                <option value="3500000">3.5 million</option>
                                <option value="4000000">4 million</option>
                                <option value="4500000">4.5 million</option>            
                                <option value="5000000">5 million</option>
                                <option value="10000000">10 million</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="search-button button-yellow">Find Properties</button>
                    </div>
                    {{ Form::close() }}
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
                        Office | 603.677.7012<br>
                        livenlove_realty@yahoo.com<br>
                        736 Cityland Mega Plaza, ADB Ave., Ortigas Center, Pasig City</p>
                </div>
            </div>