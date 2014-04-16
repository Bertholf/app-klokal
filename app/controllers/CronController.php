<?php
class CronController extends BaseController {
	public function updateTopics()
	{
		$tag_count = array();
		$tags = Tag::lists('id');
		for ($i=0; $i<count($tags); $i++){
			$tag_count[] = UserTag::select(DB::raw(' user_tag.* , count(user_tag.tag_id) as ctid, users.klout_metric_score'))
						->join('users', 'users.id', '=', 'user_tag.user_id')
						->where('user_tag.tag_id', '=', $tags[$i])
						->where('users.active', '=', '1')
						->where('users.twitter_handle', '!=', 'NULL')
						->where('users.location_id', '=', '1')
						->where('users.type_id', '=', '1')
						->orderBy('user_tag.tag_id')
						->orderBy('users.klout_metric_score')
						->first();
			
		}
			echo 'Uptade Info';
			echo '<br/>';
		foreach ($tag_count as $tag_counht_key => $tag_counht_value)
		{
			
			echo 'Tag id:'.$tag_counht_value->tag_id;
			echo PHP_EOL;
			echo 'Tag Count:'.$tag_counht_value->ctid;
			echo PHP_EOL;
			echo 'User id:'.$tag_counht_value->user_id;
			echo PHP_EOL;
			echo 'User klout_metric_score:'.$tag_counht_value->klout_metric_score;
			echo '<br/>';
			echo '<br/>';
			$tag = Tag::where('id', $tag_counht_value->tag_id)
						->update(array('count' => $tag_counht_value->ctid , 'user_id' => $tag_counht_value->user_id,));
		}
	}
	public function updateUserKloutId()
	{
		// Set your client key and secret
		$kloutapi_key = "9sbxzk9g43ka9975dbhzzj5p";
		// Load the Foursquare API library
		$klout = new KloutAPIv2($kloutapi_key);
		$user = User::select('id', 'twitter_handle')
				->where('type_id','=','99')
				->where('klout_id','is', 'NULL')
				->take(250)		
				->get();
// 				$queries = DB::getQueryLog();
// 				$last_query = end($queries);
// 				dd($last_query);
// 		dd($user);
		foreach ($user as $user_key => $user_value){
// 			dd($user_value->id);
			$KloutID = $klout->KloutIDLookupByName("twitter",$user_value->twitter_handle);
			if ($KloutID > 0) {
				$User = User::where('id', $user_value->id)
				->update(array('klout_id' => $KloutID));
				echo "KloutID: $KloutID Added<br />";
			} // Has ID 
			else {
				$User = User::where('id', $user_value->id)
				->update(array('klout_id' => '0'));
				echo "KloutID: $KloutID Doesnt Exist<br />";
			}
		}
	}
	public function discoverKlout($TwitterUser)
	{
		$twitter_config = Config::get('twitter');
		$klout = new KloutAPIv2($twitter_config['klout_key']);
		if (isset($TwitterUser) && !empty($TwitterUser)) {
			$user = User::where('twitter_handle', '=', $TwitterUser)->get();
			dd($twitter_config['TwitterDataURL'].$TwitterUser); //bug
			if(count($user) == 0){
				$CurlHandler = curl_init($twitter_config['TwitterDataURL'].$TwitterUser);
				curl_setopt( $CurlHandler, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $CurlHandler, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );
				$CurlResult = curl_exec( $CurlHandler );
				if (FALSE === $CurlResult)
					throw new Exception(curl_error($CurlHandler), curl_errno($CurlHandler));
				
				$ResultString = json_decode($CurlResult);
				dd(json_decode($ResultString));
				$Account->TwitterData = json_decode($CurlResult);
				$UserName = $Account->TwitterData->name;
				echo $UserName;
				$UserTwitterID = $Account->TwitterData->id_str;
				$UserTwitterHandle = $Account->TwitterData->screen_name;
				$UserText = $Account->TwitterData->description;
				$UserLocation = $Account->TwitterData->location;
				$UserImage = $Account->TwitterData->profile_image_url;
				$UserURL = $Account->TwitterData->url;
				$UserStatFollowers = $Account->TwitterData->followers_count;
				$UserStatFriends = $Account->TwitterData->friends_count;
				$UserDateSignup = date("Y-m-d H:i:s",strtotime($Account->TwitterData->created_at));
				$UserTimeZone = $Account->TwitterData->time_zone;
				
				$KloutID = $klout->KloutIDLookupByName("twitter",$TwitterUser);
				if ($KloutID > 0) {
					echo "KloutID: $KloutID <br />";
				
					$CurlResult = $klout->KloutUserScore($KloutID);
					$ResultString = json_decode($CurlResult);
					$KloutScore = $ResultString->score;
					$dayChanges = $ResultString->scoreDelta->dayChange;
					$weekChanges = $ResultString->scoreDelta->weekChange;
					$monthChanges = $ResultString->scoreDelta->monthChange;
					
					if (isset($KloutScore)) {
						// Create Record
											$user = new User();
											$user->name = $TwitterUser;
											$user->twitter_handle = $UserTwitterHandle;
											$user->twitter_id = $UserTwitterID;
											$user->image = $UserImage;
											$user->location = mysql_real_escape_string($UserLocation);
											$user->date_created = date('Y-m-d H:i:s',time());
											$user->topics = $UserTopics;
											$user->klout_metric_score = $KloutScore;
											$user->klout_metric_score_day = $dayChanges;
											$user->klout_metric_score_week = $weekChanges;
											$user->klout_metric_score_month = $monthChanges;
											$user->location_id = 1;
											$user->type_id = 1;
											$user->twitter_metric_followers = $UserStatFollowers;
											$user->twitter_metric_friends = $UserStatFriends;
											$user->twitter_date_created = $UserDateSignup; //?
											$user->twitter_updated = date('Y-m-d H:i:s',time());
											$user->active = 1;
											$user->save();
							
											echo "<strong>$TwitterUser</strong> Added with score <strong>". round($KloutScore) ."</strong><br />";
						echo "<br />";
					} else {
						echo "<strong>$TwitterUser</strong> Missing Data<br />";
					}
				}else{
					echo "User <strong>$TwitterUser</strong> Has No Klout ID";
					}
			}else{
				echo "User <strong>$TwitterUser</strong> Exists";
			}
		}else{
			echo "No User Specified";
		}
		
	}
	public function refreshKlout()
	{
		$yestoday = date('Y-m-d H:i:s', strtotime('-1 day'));
		// Set your client key and secret
		$kloutapi_key = "9sbxzk9g43ka9975dbhzzj5p";
		// Load the Foursquare API library
		$klout = new KloutAPIv2($kloutapi_key);
		$user_list = User::select ('id','klout_id','twitter_handle','klout_updated')
		->where('active', '=', 1)
		->where('location_id', '=', 1)
		->where('klout_id', '>', 0)
		->where('klout_updated', '<', $yestoday)
		->orderBy('klout_metric_score','DESC')
		->orderBy('twitter_updated','DESC')
		->take(100)
		->get();
		foreach($user_list as $user_key => $user_value){
			$UserID = $user_value->id;
			$UserKloutID = $user_value->klout_id;
			echo "<hr /><div><h1>". $user_value->twitter_handle ."</h1></div>";
			
			$CurlResult = $klout->KloutUserScore($user_value->klout_id);
			$ResultString = json_decode($CurlResult);
			$KloutScore = $ResultString->score;
			$dayChanges = $ResultString->scoreDelta->dayChange;
			$weekChanges = $ResultString->scoreDelta->weekChange;
			$monthChanges = $ResultString->scoreDelta->monthChange;
				
			echo "<strong>Score: ". $KloutScore ."</strong><br />";
			echo "Day: ". $dayChanges ."<br />";
			echo "Week: ". $weekChanges ."<br />";
			echo "Month: ". $monthChanges ."<br />";
			
			if ($KloutScore > 0) {
				// Update DB
				$user_update = User::where('id', '=', $UserID)->update(array(
						'klout_metric_score' => $KloutScore,
						'klout_metric_score_day' => $dayChanges,
						'klout_metric_score_week' => $weekChanges,
						'klout_metric_score_month' => $monthChanges,
						));
				echo "<br /><em>Updated scores</em>";
			}
			/* ************************************************** */
			// Get Topics
			$kloutTopicsRaw = $klout->KloutUserTopics($UserKloutID);
			$kloutTopics = json_decode($kloutTopicsRaw);
			
			foreach($kloutTopics as $kloutTopic):
			$TopicTitle = stripslashes($kloutTopic->topicData->displayName);
			$TopicImage = stripslashes($kloutTopic->topicData->imageUrl);
			$TopicSlug = $kloutTopic->topicData->slug;
			$TopicStrength = stripslashes($kloutTopic->strength);
			// Get Strength
			if ($TopicStrength == "strong") { $UserTopicStrength = 5; }
			elseif ($TopicStrength == "medium") { $UserTopicStrength = 3; }
			elseif ($TopicStrength == "low") { $UserTopicStrength = 1; }
		
			// Does the topic exist
			$tag = Tag::where('slug', '=',$TopicSlug)->first();
			if(count($tag)>0) {
					$TopicID = $tag->id;
					echo "Topic".$TopicTitle." Exists in kLokal<br />";
			} else {	
				$tag = Tag::where('title', '=',$TopicTitle)->first();
				if(count($tag)>0){
					$TopicID = $tag->id;
					echo "Topic".$TopicTitle." Exists in kLokal<br />";
				}else{
					$insertTag = new Tag();
					$insertTag->title = $TopicTitle;
					$insertTag->image = $TopicImage;
					$insertTag->slug = $TopicSlug;
					$insertTag->active = 1;
					$insertTag->save();
					$TopicID = $insertTag->id;
						
					echo "<div class=\"topic\">\n";
					echo "  <a href=\"http://klout.com/". $TopicSlug ."\" target=\"_blank\"><img src=\"". $TopicImage ."\" /></a>\n";
					echo "  <a href=\"http://klout.com/". $TopicSlug ."\" target=\"_blank\">". $TopicTitle ." Added Topic to kLokal</a>\n";
					echo "</div>";
				}
			}
			
			// Link it to the Member
			$user_tag = UserTag::where('user_id', '=', $UserID)
							->where('tag_id', '=', $TopicID)
							->get();
			if(count($user_tag) == 0){
				$user_tag = new UserTag();
				$user_tag->user_id = $UserID;
				$user_tag->tag_id = $TopicID;
				$user_tag->date_created = date('Y-m-d H:i:s',time());
				$user_tag->actor_user_id = 0;
				
				echo "<div class=\"topic\">\n";
				echo "  <a href=\"http://klout.com/". $TopicSlug ."\" target=\"_blank\"><img src=\"". $TopicImage ."\" style=\"width: 20px;\" /></a>\n";
				echo "  <a href=\"http://klout.com/". $TopicSlug ."\" target=\"_blank\">". $TopicTitle ." Added topic to User</a>\n";
				echo "</div>";
			}				
			endforeach;
			/* ************************************************** */
		}
		if(count($user_list) < 1){
			echo "No profiles need updating.";
		}
	} 
}