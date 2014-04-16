<?php
class Location extends  Eloquent {

	protected $table = 'locations';
	public $timestamps = false;
	//LocationID
	protected $fillable = array('LocationTitle', 'LocationText', 'LocationEpicenter','LocationLongitude', 'LocationLatitude', 'LocationRadius','LocationImage', 'LocationScan', 'LocationActive');
}