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
			var_dump($twitter_handle);die;
			$title = Input::get('tag');
			$text = '';
			$image = '';
			if (Input::hasFile('tagImage'))
			{
				$path = Input::file('tagImage')->getRealPath();
			}
			$slug = str_replace(' ', '-',  strtolower(trim($title)));
			$active = 1;
			$user_id = Input::get('userId');
			$count = 1;
			$date_updated = date('Y-m-d H:i:s',time());
			$date_created = date('Y-m-d H:i:s',time());
			// Create a new tag in the tag table
			$tag = Tag::create(array('title' => $title, 'text' => $text, 'image' => $image,'title' => $title, 'slug' => $slug, 'active' => $active,'count' => $count, 'user_id' => $user_id, 'date_updated' => $date_updated, 'date_created' => $date_created));
			// 			$insertedId = $tag->id;
			return Redirect::to("/user/{$twitter_handle}");
		}
	}
	
	public function updateTagByUserId()
	{
		$user_id = Input::get('user_id');
		$tag_id = Input::get('tag_id');
		dd(Input::all());
	
	}
	
}
