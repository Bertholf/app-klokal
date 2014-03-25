<?php

class GuestController extends BaseController {

	public function index()
	{
		return View::make('guest.index');
	}

}