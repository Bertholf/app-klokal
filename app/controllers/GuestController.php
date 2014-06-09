<?php

class GuestController extends BaseController {

	public function index()
	{
		if(Auth::check()) return Redirect::to('/dashboard');
		return View::make('guest.index');
	}

	public function termsOfService()
	{
		return View::make('guest.terms-of-service');
	}

	public function privacyPolicy()
	{
		return View::make('guest.privacy');
	}

}