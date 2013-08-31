<?php

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\UserNotActivatedException;

class AuthController extends BaseController {

	public $layout = 'layouts.bootstrap';

	public $loginView = 'pages.login';
	public $loginPage = 'login';
	public $postLoginPage = '/';

	public function getIndex(){
		$this->layout->content = View::make($this->loginView);
	}

	public function getLogout(){
		Sentry::logout();
		Session::flash('success', 'Logout successful');

		return Redirect::to($this->loginPage);
	}

	public function postIndex(){
		try
		{
		    // Set login credentials
		    $credentials = array(
		        'email'    => Input::get('email'),
		        'password' => Input::get('password'),
		    );

		    // Try to authenticate the user
		    $user = Sentry::authenticate($credentials, Input::get('remember'));
		    return Redirect::to($this->postLoginPage);
		}
		catch (LoginRequiredException $e)
		{
		    Session::flash('error', 'Login field is required.');
		}
		catch (PasswordRequiredException $e)
		{
		    Session::flash('error', 'Password field is required.');
		}
		catch (WrongPasswordException $e)
		{
		    Session::flash('error', 'Wrong password, try again.');
		}
		catch (UserNotFoundException $e)
		{
		    Session::flash('error', 'User was not found.');
		}
		catch (UserNotActivatedException $e)
		{
		    Session::flash('error', 'User is not activated.');
		}

		return Redirect::to($this->postLoginPage);
	}
}
