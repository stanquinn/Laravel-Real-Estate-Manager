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
<!-- Container -->
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please sign in</h3>
                </div>
                <div class="panel-body">
                    @if(Session::has('warning'))
                    <div class="alert alert-danger"><button data-dismiss="alert" class="close" type="button">&times;</button>{{ Session::get('warning') }}</div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success"><button data-dismiss="alert" class="close" type="button">&times;</button>{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('errors'))
                    <div class="alert alert-danger">
                        <button data-dismiss="alert" class="close" type="button">&times;</button>
                        <h4>Warning!</h4>
                        @foreach($errors->all() as $message)
                        {{ $message }}<br>
                        @endforeach
                    </div><!--alert-->
                    @endif

                    <form accept-charset="UTF-8" role="form" method="POST" action="">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me"> Remember Me
                                </label>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ./ container -->
<!-- Javascripts
================================================== -->
<script src="{{ asset('js/jquery-2.0.2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/restfulizer.js') }}"></script>
<!-- Thanks to Zizaco for the Restfulizer script.  http://zizaco.net  -->
</body>
</html>

