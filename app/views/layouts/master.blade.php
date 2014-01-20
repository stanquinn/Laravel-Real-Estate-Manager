<html>
<head>
    <meta charset="UTF-8">
    <title>
        @if(isset($page_title))
            {{ $page_title }} |
        @endif
        Real Estate Management
    </title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="<?php echo URL::to('frontend/style.css');?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo URL::to('frontend/style-headers.css');?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo URL::to('frontend/style-colors.css');?>" rel="stylesheet" type="text/css" media="screen">
    <link href="<?php echo URL::to('frontend/custom.css');?>" rel="stylesheet" type="text/css" media="screen">
    <!--[if lt IE 9]>

    <link href="<?php echo URL::to('frontend/style-ie.css');?>" rel="stylesheet" type="text/css" media="screen">
    <![endif]-->
</head>

<body class="home color-green">
<div class="root">
    <header class="h10 sticky-enabled no-topbar">
        <section class="top">
            <div>
                <p></p>
                <nav>
                    <ul>
                        <li><a href="{{ URL::to('/') }}">Home</a></li>
                        <li><a href="{{ URL::to('about-us') }}">About Us</a></li>
                        <li><a href="{{ URL::to('services') }}">Services</a></li>
                        <li><a href="{{ URL::to('contact-us') }}">Contact Us</a></li>
                    </ul>
                    <select id="top-nav" name="sec-nav">
                        <option value="#" selected="selected">Top Menu</option>
                        <option value="{{ URL::to('/') }}">Home</option>
                        <option value="{{ URL::to('about-us') }}">About Us</option>
                        <option value="{{ URL::to('services') }}">Services</option>
                        <option value="{{ URL::to('contact-us') }}">Contact Us</option>
                    </select>
                </nav>
            </div>
        </section>

        <section class="main-header">
            <div>
                <p class="title"><a href="{{ URL::to('/') }}"><img src="{{ URL::to('/logo.png') }}" alt="MultiPurpose"/></a></p>
                <form method="get" class="searchform" action="{{ URL::to('search') }}">
                    <fieldset>
                        <input type="text" value="" name="s" id="s" placeholder="Search">
                        <button type="submit" id="searchsubmit" value="Search"></button>
                    </fieldset>
                </form>
            </div>


        </section>
        <nav class="mainmenu">
            <ul>
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                <li><a href="{{ URL::to('about-us') }}">About Us</a></li>
                <li><a href="{{ URL::to('services') }}">Services</a></li>
                <li><a href="{{ URL::to('news') }}">News</a></li>
                <li><a href="{{ URL::to('properties') }}">Properties</a></li>
                <li><a href="{{ URL::to('properties/search') }}">Search</a></li>
                <li><a href="{{ URL::to('contact-us') }}">Contact Us</a></li>
            </ul>
            <div class="clear"></div>
            <select id="sec-nav" name="sec-nav">
                <option value="{{ URL::to('/') }}">Home</option>
                <option value="{{ URL::to('about-us') }}">About Us</option>
                <option value="{{ URL::to('services') }}">Services</option>
                <option value="{{ URL::to('news') }}">News</option>
                <option value="{{ URL::to('properties') }}">Properties</option>
                <option value="{{ URL::to('properties/search') }}">Search</option>
                <option value="{{ URL::to('contact-us') }}">Contact Us</option>
            </select>
        </nav>

    </header>
    @yield('content')
    <footer>
        <section class="bottom">
            <p>Copyright 2012-2013 <a href="#">Live and Love</a> | All rights reserved </a></p>
            <nav class="social">
                <ul>
                    <li><a href="#" class="facebook">Facebook</a></li>
                    <li><a href="#" class="twitter">Twitter</a></li>
                    <li><a href="#" class="googleplus">Google+</a></li>                 
                    <li><a href="#" class="pinterest">Pinterest</a></li>
                    <li><a href="#" class="rss">RSS</a></li>
                </ul>
            </nav>
        </section>
    </footer>
</div>

<script type="text/javascript" src="{{ URL::to('frontend/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('frontend/js/scripts.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('frontend/js/jquery.easytabs.min.js') }}"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="{{ URL::to('frontend/js/ie.js') }}"></script>
<![endif]-->
</body>
</html>