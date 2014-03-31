<?php
class TagController extends BaseController {

	public function index()
	{
		$tags = Tag::orderBy('count', 'DESC')->with('topUser')->paginate(10);

		return 	View::make('tag.index', array('tags'=>$tags));
	}

	public function addTag()
	{
		if (Input::has('tag'))
		{
			$user_id = Input::get('userId');
			$twitter_handle = Input::get('twitterHandle');
			$title = Input::get('tag');
			$text = '';
			$image = '';
			if (Input::hasFile('tagImage'))
			{
				$path = Input::file('tagImage')->getRealPath();
			}
			$slug = str_replace(' ', '-',  strtolower(trim($title)));
			$slug = str_replace('&', '-and-',  strtolower(trim($slug)));
			$active = 1;
			$user_id = Input::get('userId');
			$count = 1;
			$date_updated = date('Y-m-d H:i:s',time());
			$date_created = date('Y-m-d H:i:s',time());
			// Create a new tag in the tag table
			
			$tag = Tag::create(array('title' => $title, 'text' => $text, 'image' => $image,'title' => $title, 'slug' => $slug, 'active' => $active,'count' => $count, 'user_id' => $user_id, 'date_updated' => $date_updated, 'date_created' => $date_created));
			$tag_id = $tag->id;
			
			//create a new record in user_tag table
			$this->addUserTag($user_id, $tag_id);
			
			return Redirect::to("/user/{$twitter_handle}");
		}
	}
	
	public function updateTagByUserId($twitter_handle,$user_id, $tag_id)
	{
		$user_id = intval($user_id);
		$tag_id = intval($tag_id);
		
		$this->addUserTag($user_id, $tag_id);

		$user_top_tag = Tag::where('id', '=', $tag_id)
							->orderBy('count', 'DESC')->first();
		
		$tag_count = UserTag::select(DB::raw(' * , count(user_id) as cuid'))
						->where('tag_id', '=', $tag_id)
						->groupBy('user_id')
						->orderBy('cuid','DESC ')
						->first();
		
		$queries = DB::getQueryLog();
		$last_query = end($queries);

		//update  tag count and user_id here 
		if($user_top_tag->count < $tag_count->cuid){
			$tag = Tag::where('id', $tag_id)
						->update(array('count' => $tag_count->cuid , 'user_id' => $tag_count->user_id));
		} 

		return Redirect::to("/user/{$twitter_handle}");
		
	}
	
	public function addUserTag($user_id, $tag_id){
		$user_tag = new UserTag;
		$date_created = date('Y-m-d H:i:s',time());
		
		$user_tag->tag_id = $tag_id;
		$user_tag->user_id = $user_id;
		$user_tag->date_created = $date_created;
		$user_tag->actor_user_id = 0;
		$user_tag->save();
	}
	
}
