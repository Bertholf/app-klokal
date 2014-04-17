<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href=" /ico/favicon.png">

		<title>Klout and Klout Local</title>

		<!-- Bootstrap core CSS -->
		{{ HTML::style('stylesheets/css/style.css') }}
		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="/js/html5shiv.js"></script>
			<script src="/js/respond.min.js"></script>
		<![endif]-->

		<!-- Custom styles for this template -->
	</head>

	<body>

	<div id='wrap'>

		<div class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="/"><img src='/images/logo.png'></a>
				</div>
				<div class="navbar-collapse collapse">
					<div class='navbar-right sponsor'>
						<img src='/images/Klout.png'>
					</div><!--/.navbar-right-->
				</div><!--/.nav-collapse -->
				@if (Auth::check())
				<div style="text-align: right">
				<form class="form-inline" id='user-filter' role="form" method='post' action='/change/location'>
				<div class='col-sm-4' style='padding-right:0px !important; padding-left:0px !important; width: 160px;'>
                      <label class="sr-only" for="location">Location</label>
                      <select class='form-control' name='current_location'>
                        <option value='' disabled selected style='display:none;'>
                        <?php if(Session::get('current_location')){
                        	$location = Location::where('LocationID', '=', Session::get('current_location'))->first();
                        	if(count($location) == 1){
                        	 	echo $location->LocationTitle;
                        	}else{
                        		echo 'Location2';
                        	}
                        	}else{
                        		echo "Location";
							}
                       ?>
                        </option>
                         @foreach($location_list as $location_key => $location_value)
                        <option value="{{$location_value->LocationID}}">{{$location_value->LocationTitle}}</option>
                    	 @endforeach  
                      </select>
               </div><!--/.col-sm-3-->
               <div class='col-sm-1' style='padding-right:0px !important; padding-left:0px !important;'>
                      <button type="submit" class="btn btn-primary btn-block">Change</button>
               </div><!--/.col-sm-3-->
               </form>
					<span>Hi, </span>
					<a href="/user/{{Auth::user()->twitter_handle}}">{{ Auth::user()->name }}</a>
					<span> | </span>
					<a href="/logout">Logout</a>
				</div>
				@else
				<div style="text-align: right">
					<a href="/sign_in_with_twitter">Login</a>
				</div>
				@endif
			</div>
		</div><!--/.navbar-->

		@yield('content')

	</div><!--/.wrap-->

	<!-- FOOTER -->
	<div id='footer'>
		<div class='container'>
			<p class="pull-right"><a href="#">Back to top</a></p>
			<p>&copy; 2014 SaaS Venture Group &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
		</div><!--/.container-->
	</div><!--/.footer-->


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/holder.js"></script>
		<script src="/js/plugins/typeahead/bootstrap-typeahead.min.js"></script>
		<script src="/js/autocomplete.js"></script>
	</body>
</html>
