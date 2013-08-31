<?php namespace Admin;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\UserNotActivatedException;

class AuthController extends \AuthController {

	public $layout = 'admin.layouts.default';

	public $loginView = 'admin.login';
	public $loginPage = 'admin/login';
	public $postLoginPage = '/admin';
}
