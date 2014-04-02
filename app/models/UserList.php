<?php
class UserList extends  Eloquent {
	
	public $timestamps = false;
	protected $table = 'user_list';
	protected $fillable = array('list_id', 'user_id', 'date_created','user_listedby');
}