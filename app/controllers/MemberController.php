<?php

class MemberController extends BaseController {

	public function index()
	{

		$users = User::select('name', 'twitter_handle', 'klout_metric_score')
				->orderBy('klout_metric_score', 'desc')
				->where('location_id', '=', 1)
				->where('type_id', '=', 1)
				->take(10)
				->get();
		
		$types = Type::where('featured', '=', 1)
				->get();

		return View::make('member.index')->withUsers($users)->withTypes($types);
	}

	public function type($slug)
	{
		$type = Type::where('slug', '=', $slug)->with('users')->first();

		return View::make('member.type')->withType($type);
	}
}