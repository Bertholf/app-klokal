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
	
	public function addList()
	{
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
	
	public function addListForUser()
	{
		$post = Input::all();
		if($post){
			
				$url = '';
				if(isset($post['twitterHandle'])){
					$twitterHandle = $post['twitterHandle'];
				}else{
					$twitterHandle = '';
				}
				
				$list_id = $post['list_id'];
				$user_id = $post['user_id'];
				$user_listedby = $post['user_listedby'];
				$date_created = date("Y-m-d H:i:s",time());
				
				$list = Lists::where('id', '=', $list_id)->first();
				if($list) // input list exist
				{
					if(intval($list->user_id)>0)
					{
						$user = User::where('id', '=', $list->user_id)->first();
						$url = "user/{$user->twitter_handle}/{$list->slug}"; //customer list
					
					}else{
						$url = "lists/{$list->slug}"; //default list
					}
					
					$duplicate = UserList::where('list_id', '=', $list_id)
					->where('user_id','=', $user_id)
					->get();
					
					if(count($duplicate)>0) //this user already have got this list
					{
						if (!empty($twitterHandle)) //add list for user from user edit
						{
							return Redirect::to('/user/'.$twitterHandle);
						}else{					    //add list for user from list edit
							return Redirect::to($url);
						}
					}else{					//add a list for this user
						$user_list = new Userlist();
						$user_list->list_id = $list_id;
						$user_list->user_id = $user_id;
						$user_list->user_listedby = $user_listedby;
						$user_list->date_created = $date_created;
						$user_list->save();
							
						if (!empty($twitterHandle))
						{
							return Redirect::to('/user/'.$twitterHandle);
						}else{
							return Redirect::to($url);
						}
					}	
				}else{ //input list doesn't exist
					return Redirect::to('/dashboard');
				}
					
				
		}else {
			return Redirect::to('/dashboard');
		}
		
		
	}
	
	public function select()
	{
		$i = 0;
		$query = Input::all();
		$str = $query['search'];
		$result = Lists::where('active', '=', 1)
						->where('title', 'like' ,'%'.$str.'%')->get();
		
		foreach($result as $key => $value)
		{	
			$list[$i]['id'] = $value->id;
			$list[$i]['title'] = $value->title;
			if($i<count($result)) $i++;
		}
		return json_encode($list);
	}
	
	public function selectUser()
	{
		$i = 0;
		$query = Input::all();
		$str = $query['search'];
		$result = User::where('twitter_handle', 'like' ,'%'.$str.'%')->get();
		$users = array();
		foreach($result as $key => $value)
		{
			$users[$i]['id'] = $value->id;
			$users[$i]['name'] = $value->name;
			if($i<count($result)) $i++;
		}
		return json_encode($users);
	}
}