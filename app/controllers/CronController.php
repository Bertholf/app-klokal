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
}