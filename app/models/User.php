<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Ardent implements UserInterface, RemindableInterface {

	/**
	* Ardent validation rules
	*/
	public static $rules = array(
		'username' => 'required|min:3|max:80|alpha_dash|unique:users',
		'email'     => 'required|between:3,64|email|unique:users',
		'password'  =>'required|alphanum|between:4,8'
	);

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

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public static function destroy($id){

		$currentUser = Auth::user();
		if($id == $currentUser->id){
			throw new Exception("You can not delete yourself", 1);
		}

	   	return parent::destroy($id);
	}

	public function roles(){
        return $this->belongsToMany('Role');
    }

    public function isAdmin(){
    	$roles = $this->roles;

    	foreach ($roles as $role) {
    		if($role->level > 1) return true;
    	}

    	return false;
    }

}