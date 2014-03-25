<?php
// Call Dependencies
	require_once('config.php');
	require_once('class-klout.php');


// Initiate
	echo "<html><head><meta http-equiv='refresh' content='30'></head><body>";
	echo "<h1>Klout Assign</h1>";

	$klout = new KloutAPIv2(Klout_Key);

	// Count
	$i_exist = 0;
	$i_error = 0;
	$i_added = 0;
	$array_exist = "";
	$array_added = "";
	$array_error = "";

/* Get Users */
	$query = "SELECT id, twitter_handle, klout_id FROM users WHERE location_id = 1 AND type_id = 99 AND (klout_id IS NULL OR klout_id = '' OR klout_id = 0) ORDER BY id DESC LIMIT 0, 100";
	$results = mysql_query($query) or die ('Error retreiving users');
	$count = mysql_num_rows($results);
	if($results) {
		while ($data = mysql_fetch_array($results)) {

			$id = $data["id"];
			$twitter_handle = $data["twitter_handle"];
			$klout_id = $data["klout_id"];

			$KloutID = $klout->KloutIDLookupByName("twitter",$twitter_handle);

			if ($KloutID > 0) {
				$updateKloutID = "UPDATE users SET klout_id = " . $KloutID ." WHERE id = " . $id ."";
				$resultsKloutID = mysql_query($updateKloutID) or die ('User not updated');

				// Update Stats
				$i_added++;
				$array_added .= $twitter_handle ." (FROM ". $klout_id ." TO ". $KloutID .")<br />\n";
			} elseif ($KloutID == -1) {

				// Update Stats
				$i_error++;
				$array_error .= $twitter_handle ."<br />\n";

			} else {
				$updateKloutID = "UPDATE users SET klout_id = 0 WHERE id = " . $id ."";
				$resultsKloutID = mysql_query($updateKloutID) or die ('User not updated');

				// Update Stats
				$i_exist++;
				$array_exist .= $twitter_handle ." (FROM ". $klout_id ." TO ". $KloutID .")<br />\n";
			}

		} // While
	} // Results
	mysql_free_result($results);
	if ($count < 1) {
		echo "All Klout IDs are assigned.";
	}

echo "<h1>Added ". $i_added ." Users.</h1>";
echo $array_added;

echo "<h1>Updated ". $i_exist ." Existing Users.</h1>";
echo $array_exist;

echo "<h1>Skipped ". $i_error ." Users.</h1>";
echo $array_error;
?>