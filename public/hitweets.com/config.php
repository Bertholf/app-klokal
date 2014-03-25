<?php
ini_set('display_errors', 1);

	/* MySQL */
		define('DB_NAME', 'klokal');
		define('DB_USER', 'saasventures');
		define('DB_PASSWORD', 'saas123456789'); // K10ka1Read
		define('DB_HOST', 'saas-production.ci0onk8zahio.us-east-1.rds.amazonaws.com');

		$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
		if (!$conn) {
		echo "No database connection.";
		} else {
		mysql_select_db(DB_NAME,$conn);
		}


	/* Klout */
		define('Klout_Key', 'ryfnxcfzzqhdtv84eejau5jh');


	/* Twitter */
		$consumerKey		='zISPL06c3y4OHmNKQR60Q';
		$consumerSecret		='ECrHDhASrq0u4egWqOrThtLOO93pC90l2UGQua3Us';
		$accessToken		='13044-KW7Gjl0PqlMUnAUHxaQMxTPdBENhEg5OgbmkHTCWul8';
		$accessTokenSecret	='Id2aGB6fWMTNYblNDclZAHzQ95ZXYsSWyoV6RpqA';
			define('CONSUMER_KEY', $consumerKey);
			define('CONSUMER_SECRET', $consumerSecret);
		$TwitterUsageLimit	= 'http://api.twitter.com/version/account/rate_limit_status.json';
		$TwitterSearchURL	= 'http://search.twitter.com/search.json?geocode=';
		$TwitterDataURL		= 'https://api.twitter.com/1/users/show.json?screen_name=';

		$settings = array(
			'oauth_access_token' => $accessToken,
			'oauth_access_token_secret' => $accessTokenSecret,
			'consumer_key' => $consumerKey,
			'consumer_secret' => $consumerSecret
		);



	echo "<a href='cron-twitter-discover.php'>Discover Twitter Users</a> - ";
	echo "<a href='cron-klout-assign.php'>Assign Klout ID's</a> - ";
	echo "<a href='cron-klout-update.php'>Update Klout Scores</a> - ";
	echo "<a href='task-classify.php'>Classify Users</a> ";
	echo "<hr />";

?>