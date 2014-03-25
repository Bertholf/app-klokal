<?php

class Type extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'types';
	
	public function users()
	{
		return $this->hasMany('User');
	}
}