<?php

class MemberController extends BaseController {

	public function index()
	{
		$users = User::select('name', 'twitter_handle', 'klout_metric_score', 'image')
				->orderBy('klout_metric_score', 'desc')
				->where('location_id', '=', 1)
				->where('type_id', '=', 1)
				->take(10)
				->get();
		$lists = Lists::where('featured', '=', 1)->get();

		return View::make('member.index')->withUsers($users)->withLists($lists);
	}

	public function lists($slug)
	{
		$type = Lists::where('slug', '=', $slug)->with('users')->first();
		$users = $type->users()->orderBy('klout_metric_score', 'desc')
				->where('location_id', '=', 1)
				->paginate(50);

		return View::make('member.type', array('type'=>$type, 'users'=>$users));
	}
	
	public function customlists($twitter_handle, $slug)
	{
		$actor = User::where('twitter_handle', '=', $twitter_handle)->first();
		$type = Lists::where('slug', '=', $slug)
		->where('user_id', '=', $actor->id)
		->with('users')->first();
		
		$users = $type->users()->orderBy('klout_metric_score', 'desc')
		->where('location_id', '=', 1)
		->paginate(50);
	
		return View::make('member.type', array('type'=>$type, 'users'=>$users));
	}

	public function user($twitter_handle)
	{
		$tags_id_array = array();
		$tags_count_array = array();
		$tags_count_total = 0;
		$user = User::where('twitter_handle', '=', $twitter_handle)->first();
		//list all tags for this user
		$tags = UserTag::select(DB::raw(' user_tag.user_id ,user_tag.tag_id , user_tag.actor_user_id , tag.* '))
		->join('tag','tag.id','=','user_tag.tag_id')
		->where('user_tag.user_id', '=', $user->id)
		->orderBy('user_tag.tag_id','desc')
		->get();

		if(count($tags) == 0){
			$tags_info = array();
			$tags_actor_id = array();
		}else{
			
			foreach ($tags as $tag_key => $tag_value) //merge the same item
			{
				$tags_info[$tag_value->tag_id] = $tag_value;
				$tags_actor_id[$tag_value->tag_id][$tag_value->actor_user_id] = $tag_value->actor_user_id;
			}
		}
		//user list created
		$lists = array();
		$lists = Lists::where('user_id', '=', Session::get('id'))->get();
		return View::make('member.user', array('user'=>$user, 'tags_info' => $tags_info, 'tags_actor_id' => $tags_actor_id,'lists' => $lists));
	}

	public function twitterSignIn()
	{
		$twitter_config = Config::get('twitter');
		$consumer_key = $twitter_config['consumer_key'];
		$consumer_secret = $twitter_config['consumer_secret'];
		$callback = url('twitter_callback');
		$connection = new TwitterOAuth($consumer_key, $consumer_secret);
		$request_token = $connection->getRequestToken($callback);
		
		$token = $request_token['oauth_token'];
		Session::put('oauth_token', $token);
		Session::put('oauth_token_secret', $request_token['oauth_token_secret']);
		
		switch ($connection->http_code) {
			case 200:
				$url = $connection->getAuthorizeURL($token);
				return Redirect::to($url);
				break;
			default:
				App::abort(500, 'Could not connect to Twitter.');
		}
	}

	public function twitterCallback()
	{
		if ((Input::get('oauth_token') && Session::get('oauth_token') !== Input::get('oauth_token')) || !Input::get('oauth_token')) {
			return Redirect::to('/');
		}
		
		$twitter_config = Config::get('twitter');
		$consumer_key = $twitter_config['consumer_key'];
		$consumer_secret = $twitter_config['consumer_secret'];
		
		$connection = new TwitterOAuth($consumer_key, $consumer_secret, Session::get('oauth_token'), Session::get('oauth_token_secret'));
		$access_token = $connection->getAccessToken(Input::get('oauth_verifier'));
		Session::put('access_token', $access_token);
		$user_info = $connection->get('account/verify_credentials');

		if (isset($user_info->error)) {
			return Redirect::to('/');
	    } else {
			$user = User::where('twitter_id', '=', $user_info->id)->first();

			if(empty($user)){
				$user = new User();
				$user->name = $user_info->name;
				$user->twitter_id = $user_info->id;
				$user->twitter_handle = $user_info->screen_name;
				$user->text = $user_info->description;
				$user->location = $user_info->location;
				$user->location_id = 1;		//@todo
				$user->type_id = 1;		//@todo
				$user->image = $user_info->profile_image_url;
				$user->url = $user_info->url;
				$user->twitter_metric_followers = $user_info->followers_count;
				$user->twitter_metric_friends = $user_info->friends_count;
				$user->twitter_date_created = date("Y-m-d H:i:s",strtotime($user_info->created_at));
				$user->timezone = $user_info->time_zone;
				
			}
			
			$user->twitter_oauth_token = Session::get('oauth_token');
			$user->twitter_oauth_secret = Session::get('oauth_token_secret');
			$user->twitter_logged = date('Y-m-d H:i:s');
			$klout = new KloutAPIv2($twitter_config['klout_key']);
			$kloutID = $klout->KloutIDLookupByName("twitter", $user->twitter_handle);
			
			if (!empty($kloutID)) {
				$curlResult = $klout->KloutUserScore($kloutID);
				$resultString = json_decode($curlResult);
			
				if (isset($resultString->score)) {
					$user->klout_id = $kloutID;
					$user->klout_metric_score = $resultString->score;
					$user->klout_metric_score_day = $resultString->scoreDelta->dayChange;
					$user->klout_metric_score_week = $resultString->scoreDelta->weekChange;
					$user->klout_metric_score_month = $resultString->scoreDelta->monthChange;
					$user->klout_updated = date('Y-m-d H:i:s');
				}
			}
				
			$user->save();
				Session::put('id',$user->id);
				Session::put('twitter_handle',$user_info->name);
				Session::put('location_id',$user_info->name);
				Session::put('type_id',$user_info->name);
			Auth::login($user);
					
			return Redirect::to('/dashboard');
	    }
	}

	public function logout()
	{
		Auth::logout();

		return Redirect::to('/');
	}
}