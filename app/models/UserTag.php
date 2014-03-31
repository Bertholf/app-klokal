<?php
class UserTag extends  Eloquent {
	
	public $timestamps = false;
	protected $table = 'user_tag';
	protected $fillable = array('user_id', 'tag_id', 'date_created','actor_user_id');
}