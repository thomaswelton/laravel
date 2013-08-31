<?php

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\UserNotActivatedException;

class HomeController extends BaseController
{
    public $layout = 'layouts.default';

    public function getIndex()
    {
        $this->layout->content = View::make('pages.index');
    }

    public function getLogin()
    {
        if (Sentry::check()) {
            return Redirect::to('/');
        }

        // Change the default layout
        $this->layout = 'layouts.bootstrap';
        parent::setUpLayout();

        $this->layout->content = View::make('pages.login');
    }

    public function getLogout()
    {
        Sentry::logout();
        Session::flash('success', 'Logout successful');

        return Redirect::to('/');
    }

    public function postLogin()
    {
        try {
            // Set login credentials
            $credentials = array(
                'email'    => Input::get('email'),
                'password' => Input::get('password'),
            );

            // Try to authenticate the user
            $user = Sentry::authenticate($credentials, Input::get('remember'));

            return Redirect::to('/');
        } catch (LoginRequiredException $e) {
            Session::flash('error', 'Login field is required.');
        } catch (PasswordRequiredException $e) {
            Session::flash('error', 'Password field is required.');
        } catch (WrongPasswordException $e) {
            Session::flash('error', 'Wrong password, try again.');
        } catch (UserNotFoundException $e) {
            Session::flash('error', 'User was not found.');
        } catch (UserNotActivatedException $e) {
            Session::flash('error', 'User is not activated.');
        }

        return Redirect::to('/login');
    }
}
