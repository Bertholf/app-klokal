<?php
class Social {

	private $GeoCodeURL = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=";
	private $FriendsURL     = 'http://api.twitter.com/1/statuses/friends.json?screen_name=';
	private $KloutURL		= 'http://api.klout.com/1/klout.json?key=d7vfd33v3ntkh6drk6dy93ka&users=';
	private $KloutURLShow   = 'http://api.klout.com/1/users/show.json?key=d7vfd33v3ntkh6drk6dy93ka&users=';
	private $KloutURLTopics = 'http://api.klout.com/1/users/topics.json?key=d7vfd33v3ntkh6drk6dy93ka&users=';
	private $TrstRankURL	= 'http://api.infochimps.com/soc/net/tw/trstrank.json?apikey=rob-HTzFrpm2GsV0E-HXJFNWo8TXx69&callback=callback&screen_name=';

	public function __construct() {

	}

	/*
	 * 1. Returns the Lat Long, given the address 
	 */
		public function get_geocode($address) {

			$CurlHandler = curl_init( $this->GeoCodeURL . urlencode($address) );
			curl_setopt( $CurlHandler, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $CurlHandler, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );

			$GeoCodeResult = curl_exec( $CurlHandler );
			$ResultString = json_decode($GeoCodeResult);

			$Lat	= $ResultString->results[0]->geometry->location->lat;
			$Long	= $ResultString->results[0]->geometry->location->lng;

			return array($Lat, $Long);
		}


}

?>
