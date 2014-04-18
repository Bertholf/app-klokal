<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	public $timestamps = false;
	
	public function lists()
	{
		return $this->BelongsToMany('Lists', 'user_list', 'list_id', 'user_id');
	}	

	public function userTags()
	{
		return $this->hasMany('UserTag', 'user_id');
	}
	
	public function getRankInType()
	{
		if (Session::get('current_location')){
			$current_location = Session::get('current_location');
		}else{
			$current_location = 1;
		}
		$rank = User::where('klout_metric_score', '>', $this->klout_metric_score)
				->where('type_id', '=', $this->type_id)
				->where('location_id', '=', $current_location)->count();
		return $rank+1;
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}


}