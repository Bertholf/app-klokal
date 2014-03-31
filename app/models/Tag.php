<?php
class Tag extends  Eloquent {
	
	protected $table = 'tag';
	protected $fillable = array('title', 'text', 'image','title', 'slug', 'active','count', 'user_id', 'date_updated', 'date_created');
	
	public function users()
	{
		return $this->belongsToMany('User', 'user_tag', 'user_id', 'tag_id');
	}	
	
	public function topUser()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function tagUsers()
	{
		return $this->hasMany('UserTag', 'tag_id');
	}
}