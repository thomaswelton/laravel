<?php namespace App\Models;

use LaravelBook\Ardent\Ardent;

class Config extends Ardent{

	public static $rules = array(
		'name'     => 'required'
	);
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'config';
}