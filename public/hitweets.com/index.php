<?php
include_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hawaii's First Tweets</title>

	<meta property="og:image" content="/assets/img/hawaii-tweet-400x400.png"/>
	<meta property="og:locale" content="en_US"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="HITweets - Hawaii's Early Twitter Adopters" />
	<meta property="og:description" content="List of the first tweets sent from Hawaii"/>
	<meta property="og:url" content="http://hitweets.com/"/>
	<meta property="og:site_name" content="HITweet"/>

	<!-- Bootstrap -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/timeline.css" rel="stylesheet">

	<style type="text/css">
	body { background: #f4f8f9;}
	#globalnav {position: relative;z-index: 500;box-shadow: 0 0 3px #aaa;-moz-box-shadow: 0 0 3px #aaa;-webkit-box-shadow: 0 0 3px #aaa;background: #fff;min-height: 40px;}
	.container { margin-right: auto;margin-left: auto;}
	.twitter-bird {	position: absolute;height: 19px;width: 24px;top: 0;left: 0;background: url("https://g.twimg.com/sites/all/themes/gazebo/img/sprite.png") 0 -119px no-repeat transparent; }
	.social { text-align: center; margin: 20px 0 50px 0;}
	#site-name, #credit { padding: 10px 0 0; font-size: 22px;font-weight: normal;font-family: "gazebo-cond-light-font","HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif; }
	#site-name {margin-left: 40px; float: left;}
	#site-name a, #credit a { text-decoration: none; font-size: 22px; line-height: 22px; font-weight: normal; color: #555;padding-left: 27px;position: relative; }
	.timeline-body iframe {margin: 0px !important; box-shadow: none !important; border-width: 0px !important; margin-bottom:0;border:0 !important;border-radius:0 !important;-webkit-border-radius:0;-moz-border-radius:0;}
	.saaslogo { position: relative; top: -5px;}
	.ds-btn { margin: 30px 0 0 0;}
	.ds-btn li{ list-style:none; float:left; padding:10px; }
	.ds-btn li a span{padding-left:15px;padding-right:5px;width:100%;display:inline-block; text-align:left;}
	.ds-btn li a span small{width:100%; display:inline-block; text-align:left;}

	.timeline { margin-top: 50px;}

	.first-tweet-share{ text-align: center; margin:30px 0 0;padding:30px 0 0;position:relative;}
	.first-tweet-share .heading{margin-bottom:12px;position:relative;}
	.first-tweet-share .heading:after{border-top:1px solid #999;content:' ';left:50%;margin-left:-125px;position:absolute;top:10px;width:250px;z-index:1;}
	.first-tweet-share .heading > div{display:inline-block;margin:0 auto;padding:0 10px;position:relative;z-index:2;}
	.first-tweet-share > a{display:inline-block;margin:0 6px;}
	.first-tweet-share > a img{opacity:0.80;width:25px;-webkit-transition:opacity 500ms ease;-moz-transition:opacity 500ms ease;-o-transition:opacity 500ms ease;transition:opacity 500ms ease;}
	.first-tweet-share > a:hover img{opacity:1;}@media (max-width:767px){section#gaz-content{padding-bottom:110px;}}@media (max-width:450px)

	#first-tweet-wrapper .twitter-tweet-button,.first-tweet-share .heading,#first-tweet-form input,#gaz-content-body h1,#gaz-content-body p{font-family:'Gotham Narrow SSm','Helvetica Neue',Helvetica;font-weight:200;}
	body,.first-tweet-share .heading > div{background-color:#f4f8f9;}
	.page-header {text-align:center;}
	.page-header .twitter-logo{background:url(https://g.twimg.com/sites/all/themes/gazebo/img/sprite.png) no-repeat transparent;background-position:-30px -99px;margin:30px auto 15px;height:40px;width:50px;}
	.page-header .introduction p{font-size:18px;line-height:25px;margin-bottom:8px;}
	.page-header h1{font-size:32px;font-weight:400;letter-spacing:-1px;margin-bottom:6px;}
	#first-tweet-form{margin-top:30px;}
	#first-tweet-form button,#first-tweet-form input{font-size:26px;height:auto;line-height:36px;}
	#first-tweet-form input{border-radius:10px;padding:6px 12px;}
	#first-tweet-form .input-wrapper{display:inline-block;position:relative;}
	#first-tweet-form .input-wrapper:before{color:#999;content:'@';font-size:30px;font-weight:200;height:auto;left:0;line-height:51px;position:absolute;top:0;width:45px;}
	#first-tweet-form .input-wrapper button{background:url("https://g.twimg.com/sites/discover/themes/gazebo_discover/img/magnifying-glass.png") no-repeat center center;background-size:55%;display:inline-block;height:51px;position:absolute;right:0;top:0;width:50px;border:none;}#first-tweet-form input{padding-left:38px;padding-right:38px;width:300px;}#first-tweet-wrapper{margin:30px 0;}#first-tweet-wrapper iframe{margin-left:auto !important;margin-right:auto !important;}#first-tweet-wrapper .alert{display:inline-block;}#first-tweet-wrapper .twitter-tweet-button{background-color:#01aee7;color:#fff;display:inline-block;font-size:24px;line-height:30px;padding:10px 20px;margin-top:8px;margin-bottom:20px;}#first-tweet-wrapper .twitter-tweet-button:hover{text-decoration:none;}.first-tweet-share{margin:30px 0 0;padding:30px 0 0;position:relative;}.first-tweet-share .heading{margin-bottom:12px;position:relative;}.first-tweet-share .heading:after{border-top:1px solid #999;content:' ';left:50%;margin-left:-125px;position:absolute;top:10px;width:250px;z-index:1;}.first-tweet-share .heading > div{display:inline-block;margin:0 auto;padding:0 10px;position:relative;z-index:2;}.first-tweet-share > a{display:inline-block;margin:0 6px;}.first-tweet-share > a img{opacity:0.80;width:25px;-webkit-transition:opacity 500ms ease;-moz-transition:opacity 500ms ease;-o-transition:opacity 500ms ease;transition:opacity 500ms ease;}.first-tweet-share > a:hover img{opacity:1;}@media (max-width:767px){section#gaz-content{padding-bottom:110px;}}@media (max-width:450px){#gaz-content-body h1{font-size:22px;}#gaz-content-body .introduction p{font-size:16px;}#first-tweet-form input{width:200px;}}
@media
only screen and (-webkit-min-device-pixel-ratio:2),only screen and (min--moz-device-pixel-ratio:2),only screen and (-o-min-device-pixel-ratio:2/1),only screen and (min-device-pixel-ratio:2),only screen and (min-resolution:192dpi),only screen and (min-resolution:2dppx){.twitter-bird{background-position:-14px -50px;background-size:38px 130px;}}@media (max-width:1600px){.hero-fade .hero-wrap-outer{width:auto;}.hero-fade .hero-wrap-outer:before,.hero-fade .hero-wrap-outer:after{display:none;}}@media (max-width:1175px){#ui-datepicker-div{left:50% !important;margin-left:-135px;}}@media (min-width:768px) and (max-width:979px){.container,.navbar-static-top .container,.navbar-fixed-top .container,.navbar-fixed-bottom .container{max-width:768px;}.profile-menu{margin-right:0;}#site-name{margin-left:0;}#subnav .navbar .btn-navbar{margin:10px 0 !important;}#gaz-content .container{padding:16px;width:724px;}.article-wrap.span9 .load-more{margin-left:160px;}}@media (min-width:979px){#globalnav .container,#subnav .container{width:1020px;}#subnav .menu-name-main-menu .menu.menu-overflow-hidden{overflow:hidden;height:53px;}}@media (max-width:979px){.dropdown-menu > li > a{line-height:28px;}#subnav .navbar .btn-navbar{background-color:#4cb7ea;background-image:-moz-linear-gradient(top,#4cb7ea,#0481b2);background-image:-ms-linear-gradient(top,#4cb7ea,#0481b2);background-image:-webkit-gradient(linear,0 0,0 100%,from(#4cb7ea),to(#0481b2));background-image:-webkit-linear-gradient(top,#4cb7ea,#0481b2);background-image:-o-linear-gradient(top,#4cb7ea,#0481b2);background-image:linear-gradient(top,#4cb7ea,#0481b2);background-repeat:repeat-x;background-position:0;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#'4cb7ea,endColorstr='#'0481b2,GradientType=0);filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);border:1px solid #0481b1;padding:8px 25px 8px 10px;margin:10px 40px;position:relative;}.btn-navbar:before,.btn-navbar:after{position:absolute;top:12px;right:5px;display:inline-block;border-right:6px solid transparent;border-bottom:6px solid rgba(0,0,0,0.25);border-left:6px solid transparent;border-top-color:transparent;content:'';}.btn-navbar:after{right:6px;border-right:5px solid transparent;border-bottom:5px solid white;border-left:5px solid transparent;}.btn-navbar.collapsed:before,.btn-navbar.collapsed:after{border-bottom:none;border-top:6px solid rgba(0,0,0,0.25);}.btn-navbar.collapsed:after{border-top:5px solid white;}#subnav .nav{padding:0;}#subnav .nav > li > a{margin:0;}#subnav .nav > li > a,#subnav .menu-name-main-menu > ul.nav > li{border:none;}#subnav .leaf.first a{margin-left:0 !important;}#subnav a{border-bottom:1px solid #dfdfdf;}#subnav a.active,#subnav a.active-trail{background:inherit;color:#555;}#subnav a.active:before,#subnav a.active:after,#subnav a.active-trail:before,#subnav a.active-trail:after{display:none !important;}.btn-cta{display:inline-block !important;margin:10px auto !important;}.g-navigation > .book-content > ul,.menu-name-main-menu > .book-content > ul{margin:0;width:auto;}.stat{margin:10px auto;display:block;border-right-width:0;width:auto;}.stat-wrap{display:block;}.node-type-product #hero .hero-wrap-outer{background-image:none;}body.node-type-product #hero .hero-wrap-inner{padding-right:0;text-align:center;}.view-success-story .span6:last-child .node-teaser{margin-left:auto;}#preface .views-field-field-success-story-tagline{top:130px;}#preface .views-field-field-success-story-tagline .field-content a{font-size:20px;line-height:26px;}}@media (max-width:767px){#globalnav .have-account{display:none;}.locale-switcher{margin-right:70px;}.without-subnav .locale-switcher{margin-right:0;}.divider{display:none;}h1#page-title{font-size:300%;}h2{font-size:250%;}.hero-tall h1#page-title,h3{font-size:200%;}#gaz-content-footer .start-advertising span,h4{font-size:160%;}h5{font-size:130%;}h6{font-size:110%;}#globalnav .container,#subnav .container{width:auto;}#subnav .navbar .btn-navbar{margin:0;position:absolute;top:-36px;right:20px;z-index:1001;}#site-name{margin-left:0;}#page-wrapper{background:none;}.site-banner,#globalnav,#subnav,#hero,#gaz-sub-footer,#globalfooter,#page-hero{margin:0 -20px;}#globalnav{padding:0 20px;}#subnav{padding:0;}#subnav a{margin:0;padding:16px 20px;}#subnav a.active:before,#subnav a.active:after{display:none;}#globalnav .profile-menu,#globalnav .search-form{display:none;}#subnav .search-form{display:block;float:none;margin:0;padding:8px 20px;text-align:center;background:#efefef;border-bottom:1px solid #dfdfdf;}#subnav .search-form form,#subnav .search-form .control-group{margin:0;}#subnav .search-form input{width:100%;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;}#subnav .search-form .search-form-submit{top:15px;right:28px;}#hero .g-title-eyebrow,#hero .g-teaser,#hero .g-tagline{margin:5px 0 0;line-height:1.2;}#hero .g-title-eyebrow{margin:0;}.hero-text{padding:0;}#hero .container{padding:0 20px;}#hero.hero-tall .hero-wrap-outer{min-height:150px;}#hero.hero-tall .hero-wrap-inner{height:150px;}.hero-fixed.hero-taller,.hero-fixed.hero-taller .hero-wrap-outer{height:400px;}#hero h1#page-title{font-size:28px;}.node-type-success-story #hero h1#page-title{margin:0;}.node-type-success-story #hero #tagline{margin-top:0px;font-size:16px;}.node-type-success-story #hero #page-title .divider{margin:5px auto;}#hero #tagline{font-size:18px;line-height:1.3;}#hero p#en-title{font-size:12px;}#hero .btn-play{background:url('https://g.twimg.com/sites/all/themes/gazebo/img/sprite.png') no-repeat 0 -64px;height:30px;width:30px;margin-top:5px;}#hero .g-hero-video{height:auto;width:100%;}#hero + #gaz-content .container{margin-top:-50px;}#preface .view-success-story .views-field-title{top:15%;}#preface .view-success-story .views-field-title span a{font-size:30px;}#preface .views-field-field-success-story-tagline{top:46%;}#preface .view-success-story .views-field-title:after{margin:8px auto;}#preface .views-field-field-success-story-tagline .field-content a{font-size:16px;line-height:20px;}.view-success-story{margin-top:20px;}.view-success-story .span6{margin-bottom:40px;}.view-success-story .span6 .media{margin-bottom:10px;}.view-success-story .span6 .profile-image{float:none;margin:0 auto 8px;}.view-success-story .node-success-story{text-align:center;}.page-home #hero h1#page-title{font-size:200%;}#hero .g-success-story-categories{margin-top:0;}#hero .profile-name .divider{margin:10px auto;}.article-wrap.span7 > *{margin:auto;}.article-wrap.span9 > *{margin:auto;}#preface,.article-wrap.span10 > *{margin-left:auto;margin-right:auto;}#gaz-content .container{padding:0 0 20px 0;}.book-block-menu{display:none;visibility:hidden;}#sidebar-second{margin:20px 0 0;}#sidebar-second .d-block{margin:0 0 20px;}#sidebar-second h2,#sidebar-second .content{margin-left:0;margin-right:0;}#sidebar-first-bottom .view-success-story-taxonomy{border-top:1px solid #eee;}body.node-type-product #hero h1#page-title{margin:5px 0;}#preface .g-success-story-summary{padding:10px 0 25px;}#preface .g-success-story-summary h3{margin:15px 0 0 !important;}#preface .g-success-story-summary .d-field-item:nth-of-type(even){border:none !important;}#preface .g-success-story-summary .d-field-item:last-child{padding-left:20px;}#hero + #gaz-content .container{margin-top:auto !important;}#gaz-content .container:before,#gaz-content .container:after{display:none;}#gaz-content .container{margin:0 -20px;padding:20px;}.media{margin-bottom:20px;overflow:hidden;}.view-related-success-story .node-success-story{text-align:center;margin-bottom:40px;}footer#gaz-sub-footer{padding:18px 20px 20px;}footer#globalfooter{padding:18px 20px 0;}footer#globalfooter{position:static;}#gaz-content{padding-bottom:68px;}#globalfooter .g-menu-global-footer{float:none;font-size:12px;text-align:center;}#globalfooter .copyright{display:block;float:none;background:none;padding:0;font-size:12px;text-align:center;}#globalfooter .navbar{float:left;margin-right:0;margin-left:10px;}.g-tweet .twitter-tweet-rendered.tw-align-center{width:auto !important;}.g-helper-tfw-embedded-timeline{display:none;}article .search-form > div{padding:20px;}article #edit-basic .form-submit,article #edit-basic .form-text{font-size:14px;padding:8px;}article .search-form #edit-basic .controls{right:80px;}article #edit-basic .form-submit{width:80px;}.g-blog-page .g-tweet-button{position:static;margin:10px 0;}.g-blog-page article .content{margin-left:0;}.load-more-wrap{margin:40px 0 60px;}.article-wrap.span9 .load-more{margin-left:0;}.g-table-responsive{overflow:auto;}.g-table-responsive > .table > thead > tr > th,.g-table-responsive > .table > tbody > tr > th,.g-table-responsive > .table > tfoot > tr > th,.g-table-responsive > .table > thead > tr > td,.g-table-responsive > .table > tbody > tr > td,.g-table-responsive > .table > tfoot > tr > td{white-space:nowrap;}}@media (max-width:480px){.nav-collapse{-webkit-transform:none;}.media .pull-left{float:left;}.media .pull-right{float:right;}.form-item.control-group > label{width:100%;}}@media (min-width:401px) and (max-width:979px){.g-grid-list-item,.g-grid-list > div,.twitter-account-list > div{width:50%;}}@media (max-width:400px){.g-grid-list-item,.g-grid-list > div,.twitter-account-list > div{width:100%;}}

	</style>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-46102961-5', 'hitweets.com');
	  ga('send', 'pageview');
	</script>
</head>

<body>
<div id="page-wrapper">

<nav id="globalnav" class="without-subnav">
    <div class="container">
      <div id="site-name">
        <a href="/" title="Home" class="pull-left">
          <span class="twitter-bird"></span>
          Discover Hawaii's Early Adopters</a>
      </div>
      <div id="credit" class="pull-right">
        <a href="http://saasventures.co" title="SaaS Ventures">
          <span class="saaslogo"><img src="/assets/img/logo-saas.png" alt="SaaS Ventures" /></span>
           SaaS Ventures</a>
      </div>
    </div>
</nav>

	<?php
	/* MySQL */
		if (isset($_REQUEST["year"])) {
		$year_active = $_REQUEST["year"];
		} else {
		$year_active = "2006";
		}
		?>


<div class="container">
	<div class="page-header">
		<div class="d-block d-block-system g-main">
			<div class="twitter-logo"></div>
			<h1>There's a #FirstTweet for everything.</h1>

			<div class="introduction">
			  <p>
			    Find anyone's first Tweet. Just enter the @username below to get started — where it all started.  </p>
			</div>

			<form method="get" action="https://discover.twitter.com/first-tweet" id="first-tweet-form" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="form-search" target="_blank">
			  <div class="input-wrapper">
			    <input type="text" name="username" placeholder="username" value="" autocorrect="off" autocapitalize="off" spellcheck="false">
			    <button></button>
			  </div>
			</form>
		</div>

		<div class="first-tweet-share">
		  <div class="heading">
		    <div>Share this page</div>
		  </div>
		  <a href="https://pinterest.com/pin/create/button/?url=https%3A%2F%2Fhitweets.com&amp;media=http%3A%2F%2Fg.twimg.com%2Fdiscover%2Ffirst-tweet%2Fsocial%2Ffirst-tweet-pinterest-graphic.jpg&amp;description=Ah%2C+memories%E2%80%A6+Find+your+%23FirstTweet+at+hitweets.com." title="Share this page on Pinterest" target="_blank" class="click-tracking" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="share-pinterest">
		    <img src="https://g.twimg.com/sites/discover/themes/gazebo_discover/img/pinterest-icon.png">
		  </a>
		  <a href="https://www.tumblr.com/share/link?url=https%3A%2F%2Fhitweets.com&amp;name=Ah%2C+memories%E2%80%A6&amp;description=Find+your+%23FirstTweet+at+hitweets.com" title="Share this page on Tumblr" target="_blank" class="click-tracking" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="share-tumblr">
		    <img src="https://g.twimg.com/sites/discover/themes/gazebo_discover/img/tumblr-icon.png">
		  </a>
		  <a href="https://plus.google.com/share?url=https%3A%2F%2Fhitweets.com" title="Share this page on Google+" target="_blank" class="click-tracking" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="share-google-plus">
		    <img src="https://g.twimg.com/sites/discover/themes/gazebo_discover/img/gplus-icon.png">
		  </a>
		  <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fhitweets.com" title="Share this page on Facebook" target="_blank" class="click-tracking" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="share-facebook">
		    <img src="https://g.twimg.com/sites/discover/themes/gazebo_discover/img/facebook-icon.png">
		  </a>
		</div>
		<div class="social">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://hitweets.com" data-text="List of Hawaii early adopters, see their #FirstTweet" data-via="rob" data-hashtags="HITweets">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>

		<h1>See Hawaii's First Tweets #HITweets</h1>
			<div class="introduction">
			  <p>
			    Browse by Hawaii's early adopters and what they had to say in their first tweet.
			    <br /><em style="color: #c0c0c0;">Not listed?  Send a to @klokalapp with hashtag #HITweets and you will be added!</em></p>
			</div>


		<ul class="ds-btn">
		<?php
		$query_year = "SELECT Year(`twitter_date_created`) AS timeline_year, COUNT(*) AS registrants FROM users WHERE location_id = 1 AND twitter_date_created IS NOT NULL GROUP BY Year(`twitter_date_created`) LIMIT 4";
		$result_year = mysql_query($query_year) or die ('Error retreiving users');
		$count = mysql_num_rows($result_year);
		if($result_year) {
			$timeline_yearmonth = "2006-01";
			$i = 0;
			$ia = true;
			while ($data = mysql_fetch_array($result_year)) {

				if ($data["timeline_year"] == $year_active) {
					$yearclass = " btn-primary";
					$ia = false;
				} else {
					$yearclass = " btn-info";
				}

				// Count Previous
				if ($ia == true) {
					// Add Number of Previous Users
					$i = $i + $data["registrants"];
				}
			?>
			<li>
				<a class="btn btn-lg <?php echo $yearclass; ?>" href="/year/<?php echo $data["timeline_year"]; ?>">
				<i class="glyphicon glyphicon-link pull-left"></i><span><?php echo $data["timeline_year"]; ?><br><small><?php echo $data["registrants"]; ?> Users Found</small></span></a> 
			</li>
			<?php
			}
		}
		?>
		</ul>
		<div style="clear: both;"></div>

	</div>




	<ul class="timeline">
	<?php
	$query = "SELECT twitter_handle, klout_metric_score, type_id, location_id, twitter_first, twitter_date_created FROM users WHERE twitter_first IS NOT NULL AND twitter_date_created IS NOT NULL AND location_id = 1 AND Year(`twitter_date_created`) = ". $year_active ." ORDER BY twitter_date_created asc, klout_metric_score desc LIMIT 180";
	$results = mysql_query($query) or die ('Error retreiving users');
	$count = mysql_num_rows($results);
	if($results) {
		$timeline_yearmonth = "2006-01";
		//$i = 0;
		while ($data = mysql_fetch_array($results)) {
			if (isset($data["twitter_first"])) {
				// Increase #
				$i++;

				// Odd or even?
				if ($i % 2 == 0) {
					$class = "timeline-inverted";
				} else {
					$class = "";
				}

				$date = new DateTime($data["twitter_date_created"]);
				$timeline_yearmonth_new = $date->format("Y-m");
				if ($timeline_yearmonth <> $timeline_yearmonth_new) {
					$timeline_month = $date->format("m");
					$timeline_month = date("F", mktime(0, 0, 0, $timeline_month, 10));
					$timeline_year = $date->format("Y");
				?>
				<li>
					<div class="date-change"><?php echo $timeline_month ." ". $timeline_year; ?></div>
				</li>
				<?php
				$timeline_yearmonth = $timeline_yearmonth_new;
				}
				?>
				<li class="<?php echo $class; ?>">
					<div class="timeline-badge"><?php echo $i; ?></div>
					<div class="timeline-panel">
						<div class="timeline-body">
							<blockquote class="twitter-tweet"><p>Loading...</p>&mdash; (@<?php echo $data["twitter_handle"]; ?>) <a href="<?php echo $data["twitter_first"]; ?>" data-chrome="transparent" data-datetime="<?php echo $data["twitter_date_created"]; ?>"><?php echo $data["twitter_date_created"]; ?></a></blockquote>
						</div>
					</div>
				</li>
				<?php
				//echo $data["twitter_first"] ."<hr />";
			}
		}
	}
	?>
		</ul>
	<?php
	if ($i > 179) {
		echo "<h2>Rate Limited - Need Pagination</h2>";
	}
	?>


		<ul class="ds-btn">
		<?php
		$result_year = mysql_query($query_year) or die ('Error retreiving users');
		$count = mysql_num_rows($result_year);
		if($result_year) {
			$timeline_yearmonth = "2006-01";
			$i = 0;
			$ia = true;
			while ($data = mysql_fetch_array($result_year)) {

				if ($data["timeline_year"] == $year_active) {
					$yearclass = " btn-primary";
					$ia = false;
				} else {
					$yearclass = " btn-info";
				}

				// Count Previous
				if ($ia == true) {
					// Add Number of Previous Users
					$i = $i + $data["registrants"];
				}
			?>
			<li>
				<a class="btn btn-lg <?php echo $yearclass; ?>" href="?year=<?php echo $data["timeline_year"]; ?>">
				<i class="glyphicon glyphicon-link pull-left"></i><span><?php echo $data["timeline_year"]; ?><br><small><?php echo $data["registrants"]; ?> Users Found</small></span></a> 
			</li>
			<?php
			}
		}
		?>
		</ul>
		<div style="clear: both;"></div>
	</div>
</div>
		<div class="first-tweet-share">
		  <div class="heading">
		    <div>Share this page</div>
		  </div>
		  <a href="https://pinterest.com/pin/create/button/?url=https%3A%2F%2Fhitweets.com&amp;media=http%3A%2F%2Fg.twimg.com%2Fdiscover%2Ffirst-tweet%2Fsocial%2Ffirst-tweet-pinterest-graphic.jpg&amp;description=Ah%2C+memories%E2%80%A6+Find+your+%23FirstTweet+at+hitweets.com." title="Share this page on Pinterest" target="_blank" class="click-tracking" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="share-pinterest">
		    <img src="https://g.twimg.com/sites/discover/themes/gazebo_discover/img/pinterest-icon.png">
		  </a>
		  <a href="https://www.tumblr.com/share/link?url=https%3A%2F%2Fhitweets.com&amp;name=Ah%2C+memories%E2%80%A6&amp;description=Find+your+%23FirstTweet+at+hitweets.com" title="Share this page on Tumblr" target="_blank" class="click-tracking" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="share-tumblr">
		    <img src="https://g.twimg.com/sites/discover/themes/gazebo_discover/img/tumblr-icon.png">
		  </a>
		  <a href="https://plus.google.com/share?url=https%3A%2F%2Fhitweets.com" title="Share this page on Google+" target="_blank" class="click-tracking" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="share-google-plus">
		    <img src="https://g.twimg.com/sites/discover/themes/gazebo_discover/img/gplus-icon.png">
		  </a>
		  <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fhitweets.com" title="Share this page on Facebook" target="_blank" class="click-tracking" data-tracking-category="discover" data-tracking-type="first-tweet" data-tracking-action="share-facebook">
		    <img src="https://g.twimg.com/sites/discover/themes/gazebo_discover/img/facebook-icon.png">
		  </a>
		</div>
		<div class="social">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://hitweets.com" data-text="List of Hawaii early adopters, see their #FirstTweet" data-via="rob" data-hashtags="HITweets">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>


	<script src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>
</html>