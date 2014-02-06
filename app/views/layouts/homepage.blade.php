        <section id="slider">
            <ul class="bxslider">
                @foreach($sliders as $slider)
                <li><img src="{{ Property::primary_photo($slider->id,array(960,350)) }}" title="{{ $slider->name }}" /></li>
                @endforeach
            </ul>
        </section>
        <section id="homepage-search">
            {{ Form::open(array('url' => URL::to('properties'),'method' => 'GET','class' => 'container_12')) }}
                 <div class="grid_2">
                    {{ Form::label('Location') }}<br>
                    {{ Form::select('location',Location::dropdown(true),null,array('class' => 'search-select')) }}
                    <input type="hidden" name="search" value="true">
                 </div>
                <div class="grid_2">
                    {{ Form::label('Type') }}<br>
                    {{ Form::select('type',Type::dropdown(true),null,array('class' => 'search-select')) }}
                </div>
                <div class="grid_2">
                    {{ Form::label('Developer') }}<br>
                    {{ Form::select('developer',Developer::dropdown(true),null,array('class' => 'search-select')) }}
                </div>
                <div class="grid_1">
                    {{ Form::label('Beds') }}<br>
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
                <div class="grid_1">
                    {{ Form::label('Baths') }}<br>
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
                <div class="grid_1">
                    {{ Form::label('Min Price') }}<br>
                    <select name="min" class="search-select">
                        <option value="0">Min Price</option>
                        <option value="100000">100,000</option>
                        <option value="150000">150,000</option>
                        <option value="200000">200,000</option>
                        <option value="250000">250,000</option>
                        <option value="300000">300,000</option>
                        <option value="350000">350,000</option>
                        <option value="400000">400,000</option>
                        <option value="450000">450,000</option>
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
                <div class="grid_1">
                    {{ Form::label('Max Price') }}<br>
                    <select name="max" class="search-select">
                        <option value="0">Min Price</option>
                        <option value="100000">100,000</option>
                        <option value="150000">150,000</option>
                        <option value="200000">200,000</option>
                        <option value="250000">250,000</option>
                        <option value="300000">300,000</option>
                        <option value="350000">350,000</option>
                        <option value="400000">400,000</option>
                        <option value="450000">450,000</option>
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
                <div class="grid_2">
                    <button type="submit" class="button-yellow" id="search-button">Search Houses</button>
                </div>
            </form>
        </section>