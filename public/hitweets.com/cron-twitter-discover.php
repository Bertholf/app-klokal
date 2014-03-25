<?php
	session_start();
// Call Dependencies
	require_once('config.php');
	require_once('class-social.php');
	require_once('class-twitter.php');


// Initiate
	$s = new Social();
	echo "<html><head><meta http-equiv='refresh' content='30'></head><body>";
	echo "<h1>Social Scan</h1>";

// Session
	if (isset($_SESSION['last_tweet_id'])) {
		//if ($_SESSION['last_tweet_id'] < $last_tweet_fixed) {
			$insert_field = "&max_id=". $_SESSION['last_tweet_id'];
		//} else {

		//}
	} else {
		$insert_field = "";
	}


// Get New 
	//$geocode = $s->get_geocode("1212 Nuuanu Ave, Honolulu, HI 96817");  //1212 Nuuanu Ave, Honolulu, HI 96817

// Scan
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	//$getfield = '?lang=en'. $insert_field .'&geocode='. $geocode[0] .','. $geocode[1] .',300mi&count=250'; //q=
	$getfield = '?lang=en'. $insert_field .'&geocode=21.3126226,-157.8601301,300mi&count=250'; //q=


	$requestMethod = 'GET';
echo $getfield ."<hr />";

	$twitter = new Twitter($settings);
	$response = $twitter->setGetfield($getfield)
				->buildOauth($url, $requestMethod)
				->performRequest();
	$response = json_decode($response);

	// Count
	$i_exist = 0;
	$i_error = 0;
	$i_added = 0;
	$array_exist = "";
	$array_added = "";
	$array_error = "";

	// Loop
	foreach($response->statuses as $tweet) {

		if ($tweet->user->time_zone == "Hawaii") {

			// Get Values
			if (isset($tweet->user->profile_background_image_url)) {
				$image_background = $tweet->user->profile_background_image_url;
			} else { $image_background = NULL; }
			
			if (isset($tweet->user->profile_background_image_url)) {
				$image_header = $tweet->user->profile_background_image_url;
			} else { $image_header = NULL; }

			// Does User Exist?
			$query = "SELECT id, twitter_updated FROM users WHERE twitter_id = ". $tweet->user->id ." OR twitter_handle = '". $tweet->user->screen_name ."' LIMIT 0, 1";
			$result = mysql_query($query) or die ('');
			if (mysql_num_rows($result) == 0 ) {

				// Assign Values
				$insert = "INSERT INTO users (
					twitter_id,
					name,
					twitter_handle,
					text,
					location,
					image,
					image_background,
					image_header,
					url,
					twitter_metric_followers,
					twitter_metric_friends,
					twitter_date_created,
					timezone,
					location_id,
					type_id,
					twitter_updated
					) VALUES (
					'". $tweet->user->id ."',
					'". mysql_real_escape_string($tweet->user->name) ."',
					'". $tweet->user->screen_name ."',
					'". mysql_real_escape_string($tweet->user->description) ."',
					'". mysql_real_escape_string($tweet->user->location) ."',
					'". $tweet->user->profile_image_url ."',
					'". $image_background ."',
					'". $image_header ."',
					'". $tweet->user->url ."',
					'". $tweet->user->followers_count ."',
					'". $tweet->user->friends_count ."',
					'". date("Y-m-d H:i:s",strtotime($tweet->user->created_at)) ."',
					'". $tweet->user->time_zone ."',
					1,
					99,
					NOW()
					)";
				//echo "<pre>". $insert ."</pre>";
				$results = mysql_query($insert);

				// Update Stats
				$i_added++;
				$array_added .= $tweet->user->screen_name ."<br />\n";
			} else {
				if (isset($tweet->user->screen_name) && !empty($tweet->user->screen_name)) {

					// When was it updated last?
					while ($data = mysql_fetch_array($result)) {

						// When was last update?
						$date1 = strtotime($data["twitter_updated"]);
						$date2 = date("Y-m-d H:i:s", strtotime(date("Y-m-d") . date("H:i:s")));;

						$seconds_diff = $date1 - $date2;
						$diff = floor($seconds_diff/3600/24);
						if ($diff > 16152 OR $diff < 0) {

							// User Exists
							$insert = "UPDATE users SET
								name = '". mysql_real_escape_string($tweet->user->name) ."',
								twitter_handle = '". $tweet->user->screen_name ."',
								text = '". mysql_real_escape_string($tweet->user->description) ."',
								location = '". mysql_real_escape_string($tweet->user->location) ."',
								image = '". $tweet->user->profile_image_url ."',
								image_background = '". $image_background ."',
								image_header = '". $image_header ."',
								url = '". $tweet->user->url ."',
								twitter_metric_followers = '". $tweet->user->followers_count ."',
								twitter_metric_friends = '". $tweet->user->friends_count ."',
								twitter_date_created = '". date("Y-m-d H:i:s",strtotime($tweet->user->created_at)) ."',
								timezone = '". $tweet->user->time_zone ."',
								twitter_updated = NOW()
								WHERE twitter_id = '". $tweet->user->id ."'";
							$results = mysql_query($insert);

							// Update Stats
							$i_exist++;
							$array_exist .= $tweet->user->screen_name ."<br />\n";

						} else {
							$i_error++;
							$array_error .= $tweet->user->screen_name ." (Recently Updated)<br />\n";
						}


					} // End Loop
				} else {
					echo "Error: Over Twitter Quoata<br />"; 
				}
			}
			$_SESSION['last_tweet_id'] = $tweet->id;
		}
	}

echo "<h1>Added ". $i_added ." Users.</h1>";
echo $array_added;

echo "<h1>Updated ". $i_exist ." Existing Users.</h1>";
echo $array_exist;

echo "<h1>Skipped ". $i_error .".</h1>";
echo $array_error;

echo "<h1>Last Tweet: ". $_SESSION['last_tweet_id'] ." at ". $tweet->created_at ."</h1>";
/*
*/
?>