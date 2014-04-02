<?php

class GuestController extends BaseController {

	public function index()
	{
		if(Auth::check()) return Redirect::to('/dashboard');
		return View::make('guest.index');
	}

}