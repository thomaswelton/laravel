<?php namespace Admin;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

use \Sentry;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\UserNotActivatedException;

class HomeController extends BaseController {

	public function getIndex(){
		$this->layout->content = View::make('admin.index');
	}

	public function getLogin(){
		$this->layout->content = View::make('admin.login');
	}

	public function postLogin(){
		try
		{
		    // Set login credentials
		    $credentials = array(
		        'email'    => Input::get('email'),
		        'password' => Input::get('password'),
		    );

		    // Try to authenticate the user
		    $user = Sentry::authenticate($credentials, false);
		    return Redirect::to('admin');
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

		return Redirect::to('admin/login');
	}

	public function getLogout(){
		Sentry::logout();
		Session::flash('success', 'Logout successful');
		
		return Redirect::to('admin/login');
	}
}
