<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>{{ $page_title }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap 3.0: Latest compiled and minified CSS -->
		<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<!-- Optional theme -->
		<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css"> -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
		<style>
		@section('styles')
			body {
				padding-top: 60px;
			}
		@show
		</style>
		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>
		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="{{ URL::to('admin') }}">Dashboard</a>
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav">
                  <li><a href="{{ URL::to('admin/reservations') }}">Reservations</a></li>
                  <li><a href="{{ URL::to('admin/transactions') }}">Transactions</a></li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Properties <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="{{ URL::to('admin/properties') }}">Manage Properties</a></li>
                          <li><a href="{{ URL::to('admin/properties/create') }}">Add Property</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Developers <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="{{ URL::to('admin/developers') }}">Manage Developers</a></li>
                          <li><a href="{{ URL::to('admin/developers/create') }}">Add Developer</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Types <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="{{ URL::to('admin/types') }}">Manage Types</a></li>
                          <li><a href="{{ URL::to('admin/types/create') }}">Add Type</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Locations <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="{{ URL::to('admin/locations') }}">Manage Locations</a></li>
                          <li><a href="{{ URL::to('admin/locations/create') }}">Add Location</a></li>
                      </ul>
                  </li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Contents <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="{{ URL::to('admin/posts') }}">Manage Contents</a></li>
                          <li><a href="{{ URL::to('admin/posts/create') }}">Add Post</a></li>
                      </ul>
                  </li>
	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	          		<li><a href="{{ URL::to('/')}}" target="_blank">View Site</a></li>
                    <li><a href="{{ URL::to('auth/logout')}}">Logout</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('layouts/notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>

		<!-- ./ container -->

		<!-- Javascripts
		================================================== -->
		<script src="{{ asset('js/jquery-2.0.2.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
		<script src="{{ asset('js/restfulizer.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/TableTools.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <!-- Thanks to Zizaco for the Restfulizer script.  http://zizaco.net  -->
	</body>
</html>
