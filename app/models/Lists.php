<?php

class Lists extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'list';
	public $timestamps = false;
	
	public function users()
	{
		return $this->BelongsToMany('User', 'user_list', 'list_id', 'user_id');
	}
	
	public function userList()
	{
		return $this->hasMany('userList', 'list_id');
	}
// 	public function customUsers()
// 	{
// 		return $this->BelongsToMany('User');
// 	}
}