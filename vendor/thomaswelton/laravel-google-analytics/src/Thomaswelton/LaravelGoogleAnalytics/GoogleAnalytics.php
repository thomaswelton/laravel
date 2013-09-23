<?php namespace Thomaswelton\LaravelGoogleAnalytics;

use Config;

class GoogleAnalytics {

	public $id = null;

	function __construct()
	{
		$this->id = Config::get('laravel-google-analytics::id');
	}

	public function getId()
	{
		return $this->id;
	}
}