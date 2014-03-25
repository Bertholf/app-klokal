<?php
// Call Dependencies
	require_once('config.php');
	require_once('class-klout.php');


// Initiate
	echo "<html><head><meta http-equiv='refresh' content='2000'></head><body>";
	echo "<h1>Klout Updating</h1>";

	$klout = new KloutAPIv2(Klout_Key);

	// Count
	$i_exist = 0;
	$i_error = 0;
	$i_added = 0;
	$array_exist = "";
	$array_added = "";
	$array_error = "";

/* Get Users */
	$query = "SELECT id, twitter_handle, klout_id, klout_metric_score FROM users WHERE location_id = 1 AND (klout_id IS NOT NULL AND klout_id > 0) AND (klout_updated IS NULL OR HOUR(TIMEDIFF(NOW(), klout_updated)) >=24) ORDER BY klout_metric_score DESC, id DESC LIMIT 0, 100";
	$results = mysql_query($query) or die ('Error retreiving users');
	$count = mysql_num_rows($results);
	if($results) {
		while ($data = mysql_fetch_array($results)) {

			$id = $data["id"];
			$twitter_handle = $data["twitter_handle"];
			$klout_id = $data["klout_id"];
			$klout_metric_score = $data["klout_metric_score"];

			$CurlResult = $klout->KloutUserScore($klout_id);
			$ResultString = json_decode($CurlResult);
			if (isset($ResultString->score)) {
				$KloutScore = $ResultString->score;
				$dayChanges = $ResultString->scoreDelta->dayChange;
				$weekChanges = $ResultString->scoreDelta->weekChange;
				$monthChanges = $ResultString->scoreDelta->monthChange;

				if ($KloutScore  > 0) {
				$updateKloutID = "UPDATE users SET 
								klout_metric_score = '". $KloutScore ."',
								klout_metric_score_day = '". $dayChanges ."',
								klout_metric_score_week = '". $weekChanges ."',
								klout_metric_score_month = '". $monthChanges ."',
								klout_updated = NOW()
								WHERE id = " . $id ."";
				$resultsKloutID = mysql_query($updateKloutID) or die ('User not updated');

				// Update Stats
				$i_exist++;
				$array_exist .= $twitter_handle ." (FROM ". $klout_metric_score ." TO ". $KloutScore .")<br />\n";
				} else {

					// Update Stats
					$i_error++;
					$array_error .= $twitter_handle ." (Old ". $klout_metric_score .")<br />\n";
				}
			} else {

				// Update Stats
				$i_error++;
				$array_error .= $twitter_handle ." (Old ". $klout_metric_score .")<br />\n";

			}
		} // While
	} // Results
	mysql_free_result($results);
	if ($count < 1) {
		echo "All Klout scores are updated.";
	}


echo "<h1>Updated ". $i_exist ." Existing Users.</h1>";
echo $array_exist;

echo "<h1>Skipped ". $i_error ." Users.</h1>";
echo $array_error;


?>