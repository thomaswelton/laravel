<?php

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Illuminate\Auth\UserInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel implements UserInterface
{
    public $guarded = array('_token', 'action');

    /**
    * Validation rules
    */
    public static $rules = array(
        'first_name' => 'required',
        'last_name' => 'required',
        'email'     => 'required|between:3,64|email',
        'password'  =>'required|between:4,16'
    );

    /**
     * The message bag instance containing validation error messages
     *
     * @var \Illuminate\Support\MessageBag
     */
    public $validationErrors;

    protected $fillable = array(
        'first_name',
        'last_name',
        'email',
        'password',
        'superuser',
        'groups'
    );

    public static $factory = array(
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'email',
        'password' => 'string',
        'activated' => 1,
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

    public function facebook()
    {
        return $this->hasOne('Thomaswelton\LaravelOauth\Eloquent\Facebook');
    }

    public function errors()
    {
        return $this->validationErrors;
    }

    public function update(array $attributes = array())
    {
        $rules = User::$rules;

        // If the password is not due to be updated it does not need to be validated
        if(!array_key_exists('password', $attributes) || strlen($attributes['password']) == 0){
            unset($rules['password']);
            unset($attributes['password']);
        }

        $validator = Validator::make($attributes, $rules);

        if ($validator->fails()){
            $this->validationErrors = $validator;
            return false;
        }

        foreach($this->fillable as $field){
            if(array_key_exists($field, $attributes)){
                $this->$field = $attributes[$field];
            }
        }

        return $this->save();
    }

    public function getSuperuserAttribute()
    {
        return $this->isSuperUser();
    }

    public function setSuperuserAttribute($isSuperUser)
    {
        // Return if there is no change to be made
        if($isSuperUser == $this->superuser) return;

        // Only other super admins should be able to change a users
        // Super admin permission level

        $user = Sentry::findUserByID(Auth::user()->id);

        if($user->isSuperUser()){
            $permissions = $this->getPermissions();
            $permissions['superuser'] = (bool) $isSuperUser;

            $this->permissions = $permissions;
        }else{
            throw new Exception("You do not have permission to create or edit super users", 1);
        }
    }

    public function getGroupsAttribute()
    {
        return $this->getGroups();
    }

    public function setGroupsAttribute($groups = array())
    {
        // Remove exisiting groups
        foreach ($this->groups as $group) {
            $this->removeGroup($group);
        }

        // Add new groups
        foreach ($groups as $id) {
            $group = Sentry::findGroupById($id);
            $this->addGroup($group);
        }
    }

    public function getAvatar($width)
    {
        if($this->facebook){
            return "http://graph.facebook.com/{$this->facebook->oauth_uid}/picture?type=large&width={$width}&height={$width}";
        }
        return Gravatar::src($this->email, 275);
    }

    public static function destroy($id)
    {
        $currentUser = Sentry::getUser();

        if (Auth::check() && $id == $currentUser->id) {
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
