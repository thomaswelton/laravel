<?php

use LaravelBook\Ardent\Ardent;
use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\UserNotFoundException;

class User extends Ardent{

	/**
	* Ardent validation rules
	*/
	public static $rules = array(
		'email'     => 'required|between:3,64|email',
		'password'  =>'required|between:4,8'
	);

	/**
	* Ardent hyrdate from Input
	*/
	public $autoHydrateEntityFromInput = true;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	

	public static function destroy($id){

		$currentUser = Sentry::user();
		
		if($id == $currentUser->id){
			throw new Exception("You can not delete yourself");
		}

		try
		{
		    $user = Sentry::getUserProvider()->findById($id);
		    $user->delete();
		}
		catch (UserNotFoundException $e)
		{
		    throw new Exception("User was not found.");
		}
	}
}