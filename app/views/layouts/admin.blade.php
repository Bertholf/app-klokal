<!DOCTYPE html>
<html lang="en">
 	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="shortcut icon" href="/ico/favicon.png">

	    <title>Locations - New</title>

	    <!-- Bootstrap core CSS -->
	    {{ HTML::style('stylesheets/css/style.css') }}
	    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="assets/js/html5shiv.js"></script>
	      <script src="assets/js/respond.min.js"></script>
	    <![endif]-->

	    <!-- Custom styles for this template -->

	    {{ HTML::style('stylesheets/css/admin.css') }}
  	</head>
  	 <body>
	  <div id='wrap'>
	    <div class="navbar navbar-default">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	              </button>
	          <a class="navbar-brand" href="#"><img src='/images/admin-logo.png'></a>
	        </div><!--/.navbar-header-->
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-right navbar-nav">
	                <li class=""><a href="/dashboard"><i class='icon-dashboard'> </i> Dashboard</a></li>
	                <li class='active dropdown'>
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class='icon-compass'> </i> Locations<b class="caret"></b></a>
	                  <ul class="dropdown-menu">
	                    <li><a href="/admin/location-list">Overview</a></li>
	                    <li class="divider"></li>
	                    <li><a href="/admin/location-new">Add New</a></li>
	                  </ul>
	                </li>
	                <li class='dropdown'>
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class='icon-list-ul'> </i> Categories<b class="caret"></b></a>
	                  <ul class="dropdown-menu">
	                    <li><a href="/admin/categories-list">Overview</a></li>
	                    <li class="divider"></li>
	                    <li><a href="/admin/categories-new">Add New</a></li>
	                  </ul>
	                </li>
	                <li class='dropdown'>
	                	<a href='#' class="dropdown-toggle" data-toggle="dropdown"><i class='icon-tags'> </i> Topics<b class="caret"></b></a>
	                	<ul class="dropdown-menu">
		                    <li><a href="/admin/tag-list">Overview</a></li>
		                    <li class="divider"></li>
		                    <li><a href="/admin/tag-new">Add New</a></li>
	                  </ul>
	                </li>

	                <li class='dropdown'>
	                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class='icon-user'> </i> Users <b class="caret"></b></a>
	                  <ul class="dropdown-menu">
	                    <li><a href="/admin/users-list">Overview</a></li>
	                    <li class="divider"></li>
	                    <li><a href="/admin/users-new">Add New</a></li>
	                  </ul>
	                </li>
	                <li class=""><a href="#"><i class='icon-off'> </i> Sign Out</a></li>
	              </ul>
	        </div><!--/.nav-collapse -->
	      </div><!--/.container-->
	    </div><!--/.navbar-->

	    @yield('content')
	  </div><!--/.wrap-->
	     <!-- FOOTER -->


	  <div id='footer'>
	    <div class='container'>
	      <p class="pull-right"><a href="#">Back to top</a></p>
	      <p>&copy; 2013 SaaS Venture Group &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
	    </div><!--/.container-->
	  </div><!--/.footer-->


	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	    <script src="/js/bootstrap.min.js"></script>
	    <script src="/js/holder.js"></script>
	    <script src="/js/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
	    <script src="/js/plugins/datatables/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
	    <script src="/js/plugins/datatables/dataTables.overrides.js" type="text/javascript"></script>
	    <script src="/js/plugins/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
	    <script src="/js/plugins/validate/jquery.validate.min.js" type="text/javascript"></script>
	    <script src="/js/plugins/validate/additional-methods.js" type="text/javascript"></script>
	    <script src="/js/custom.js" type="text/javascript"></script>
  </body>
</html>
