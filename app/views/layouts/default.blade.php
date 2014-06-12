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

		@include('layouts.partials.navbar')

		@yield('content')

	</div><!--/#wrap-->

		@include('layouts.partials.footer')

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/holder.js"></script>
		<script src="/js/plugins/typeahead/bootstrap-typeahead.min.js"></script>
		<script src="/js/autocomplete.js"></script>
		<script src="/js/user.js"></script>
		@yield('view_script')
		<script type='text/javascript'>
			@yield('inline_scripts')

			// Replace any of our broken images
			$('img').error(function(){
			        $(this).attr('src', '/images/placeholder.png');
			});
		</script>
	</body>
</html>
