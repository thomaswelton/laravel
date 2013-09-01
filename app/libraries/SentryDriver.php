<?php

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Hashing\BcryptHasher;
use Cartalyst\Sentry\Facades\Laravel\Sentry;

class SentryDriver extends EloquentUserProvider {

	public function __construct()
	{
		parent::__construct(new BcryptHasher(), 'User');
	}

    public function attempt($arguments = array())
    {
    	try{
    		$user = Sentry::authenticate($credentials, false);
    		return $this->login($result->id, array_get($arguments, 'remember'));
    	}catch(Exception $e){
    		return false;
    	}
    }

    public function retrieve($id)
    {
    	try
    	{
    	    return Sentry::getUserProvider()->findById($id);
    	}
    	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
    	{

    	}

    	return false;
    }

}
