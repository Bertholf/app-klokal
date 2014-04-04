<?php
use Illuminate\Support\Facades\Redirect;

class ListsController extends BaseController {

	public function index()
	{
		$users = User::select('name', 'twitter_handle', 'klout_metric_score', 'image')
				->orderBy('klout_metric_score', 'desc')
				->where('location_id', '=', 1)
				->take(10)
				->get();
		$lists = Lists::orderBy('id', 'desc')
				->paginate(4);

		return View::make('list.index')->withUsers($users)->withLists($lists);
	}
	
	public function addList(){
		if(Input::has('title'))
		{
			$list_title = Input::get('title');
			$list_slug = str_replace(' ', '-',  strtolower(trim($list_title)));
// 			$list_slug = str_replace('&', '-and-',  strtolower(trim($list_title)));
			if(strpos($list_slug, '&')){
				$list_slug = preg_replace("/&/", "-and-", $list_slug);  
			}
// 			$list_slug = $list_slug.''.time();
			$Lists = new Lists();
			$Lists->title = $list_title;
			$Lists->slug = $list_slug;
			$Lists->text = '';
			$Lists->image = '';
			$Lists->active = 1;
			$Lists->featured = 1;
			$Lists->user_id = Session::get('id');
			$Lists->save();
		}
			return Redirect::to('/dashboard');
	}
	
	public function addToUser(){
		
	}
	
	public function select(){
		$query = Input::all();
		$str = $query['search'];
		$result = Lists::where('active', '=', 1)
		->where('title', 'like' ,'%'.$str.'%')->get();
		$list = array();
		foreach($result as $key => $value)
		{
			$list[]['id'] = $value->id;
			$list[]['title'] = $value->title;
		}
		dd($list);
		
		$tags = Tag::get();
		$list = array();
		foreach ($tags as $tag){
			$list[] = $tag->title;
		}
		return json_encode($list);
		
// 		source: [
// 		{ id: 1, full_name: 'Toronto', first_two_letters: 'To' },
// 		{ id: 2, full_name: 'Montreal', first_two_letters: 'Mo' }
// 		],
// 		displayField: 'full_name'
	}
}