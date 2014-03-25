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
		
		$types = Type::select('title', 'text', 'id')
				->where('featured', '=', 1)
				->get();

		return View::make('member.index')->withUsers($users)->withTypes($types);
	}

}