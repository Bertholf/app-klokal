<?php

class Leaderboard extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


	/**
	 * Top Users.
	 *
	 * @return string
	 */
	public function getTopUsers()
	{
		//$users = User::where('users')->find(10);

		return "tada!!!";
	}


}