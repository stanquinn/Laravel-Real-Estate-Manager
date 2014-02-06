<!DOCTYPE html>
<html>
<head>
    <title>Live and Love | {{ $page_title }}</title>
    <link rel="stylesheet" href="{{ URL::to('public/css/reset.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('public/css/960_12_col.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('public/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('public/css/jquery.bxslider.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('public/js/fancybox/jquery.fancybox.css') }}" type="text/css" media="screen" />
    <script type="text/javascript" src="{{ URL::to('public/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('public/js/jquery.bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('public/js/fancybox/jquery.mousewheel-3.0.6.pack.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('public/js/fancybox/jquery.fancybox.js') }}"></script>
    <script src="{{ URL::to('public/js/numeral.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::to('public/js/scripts.js') }}"></script>
</head>
<body>
    <div id="wrapper" class="container_12">
        <header id="header">
             <h1 id="logo"><a href="#"><img src="{{ URL::to('public/img/logo.png') }}"></a></h1>
        </header>
        <nav id="nav">
              <ul>
                  <li><a href="{{ URL::to('/') }}">Home</a></li>
                  <li><a href="{{ URL::to('about-us') }}">About</a></li>
                  <li><a href="{{ URL::to('services') }}">Services</a></li>
                  <li><a href="{{ URL::to('properties') }}">Properties</a></li>
                  <li><a href="{{ URL::to('contact-us') }}">Contact Us</a></li>
                  @if(Sentry::check())
                    @if(!Sentry::getUser()->isSuperUser())
                      <li><a href="{{ URL::to('clients') }}">My Account</a></li>
                      <li><a href="{{ URL::to('clients/profile') }}">My Profile</a></li>
                      <li><a href="{{ URL::to('clients/logout') }}">Logout</a></li>
                    @endif
                  @else
                    <li><a href="{{ URL::to('clients/login') }}">Client Login</a></li>
                  @endif
              </ul>
        </nav>
        @if(isset($homepage))
            @include('layouts.homepage')
        @endif
        <div id="main" class="container_12">
            @yield('content')
        </div>
        <footer id="footer" class="container_12">
                <p>Live and Love Realty Corporation&copy; is a registered trademark licensed to Live and Love Realty Corporation. Each Office is Independently Owned and Operated.</p>
        </footer>
    </div>
</body>
</html>