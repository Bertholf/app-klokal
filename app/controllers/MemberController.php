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
		
		$types = Type::where('featured', '=', 1)->get();

		return View::make('member.index')->withUsers($users)->withTypes($types);
	}

	public function type($slug)
	{
		$type = Type::where('slug', '=', $slug)->with('users')->first();
		$users = $type->users()->orderBy('klout_metric_score', 'desc')
				->where('location_id', '=', 1)
				->paginate(50);

		return View::make('member.type', array('type'=>$type, 'users'=>$users));
	}

	public function user($twitter_handle)
	{
		$user = User::where('twitter_handle', '=', $twitter_handle)->first();
		
		return View::make('member.user', array('user'=>$user));
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
			Auth::login($user);
					
			return Redirect::to('/dashboard');
	    }
	}
}