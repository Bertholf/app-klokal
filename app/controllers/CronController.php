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
		foreach ($tag_count as $tag_counht_key => $tag_counht_value)
		{
			
			echo 'Tag id:'.$tag_counht_value->tag_id;
			echo PHP_EOL;
			echo 'Tag Count:'.$tag_counht_value->ctid;
			echo PHP_EOL;
			echo 'User id:'.$tag_counht_value->user_id;
			echo PHP_EOL;
			echo 'User klout_metric_score:'.$tag_counht_value->klout_metric_score;
			echo PHP_EOL;
			echo '-------------------NEXT-------------------';
			echo '<br/>';
			$tag = Tag::where('id', $tag_counht_value->tag_id)
						->update(array('count' => $tag_counht_value->ctid , 'user_id' => $tag_counht_value->user_id,));
		}
	}
}