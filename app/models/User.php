<?php

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Illuminate\Auth\UserInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel implements UserInterface
{
    public $guarded = array('_token', 'action');

    /**
    * Ardent validation rules
    */
    public static $rules = array(
        'email'     => 'required|between:3,64|email',
        'password'  =>'required|between:4,8'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $softDelete = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'permissions');

    public function facebook(){
        return $this->hasOne('Thomaswelton\LaravelOauth\Eloquent\Facebook');
    }

    public function getAvatar($width){
        if($this->facebook){
            return "http://graph.facebook.com/{$this->facebook->oauth_uid}/picture?type=large&width={$width}&height={$width}";
        }
        return Gravatar::src($this->email, 275);
    }

    public static function destroy($id)
    {
        $currentUser = Sentry::getUser();

        if ($id == $currentUser->id) {
            throw new Exception("You can not delete yourself");
        }

        try {
            $user = Sentry::getUserProvider()->findById($id);
            $user->delete();
        } catch (UserNotFoundException $e) {
            throw new Exception("User was not found.");
        }
    }

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
}
