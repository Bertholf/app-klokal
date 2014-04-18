<!DOCTYPE html>
<html lang="en">
 	  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Locations - Charlotte - Edit</title>

    <!-- Bootstrap core CSS -->
    <link href="/stylesheets/bootstrap.css" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="/stylesheets/custom.css" rel="stylesheet">
    <link href="/stylesheets/css/admin.css" rel="stylesheet">
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>


    <script>
      function initialize() {
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(35.2270869, -80.8431267),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(map_canvas, map_options);

        // Create a draggable marker which will later on be binded to a
            // Circle overlay.
            var marker = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(35.2270869, -80.8431267),
              draggable: false,
              title: 'Coverage'
            });
    
            // Add a Circle overlay to the map.
            var circle = new google.maps.Circle({
              map: map,
              radius: 20000 // in meters   km
            });

      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>


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
	                <li class=""><a href="/logout"><i class='icon-off'> </i> Sign Out</a></li>
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
