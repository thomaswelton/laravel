<?php namespace Admin;

use \Redirect;
use \View;
use \Input;
use \Session;
use \Exception;
use \Lang;

use Cartalyst\Sentry\Facades\Laravel\Sentry;



class HomeController extends BaseController
{
    public function getIndex()
    {
        return View::make('admin.index');
    }

    public function getLogin()
    {
        if (Sentry::check()) {
            $user =  Sentry::getUser();

            //Return if user is an admin
            if ($user->hasAccess('admin')) {
                Session::flash('info', 'Already logged in as ' . $user->email);

                return Redirect::to('admin');
            }
        }

        return View::make('admin.login');
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
            Sentry::authenticate($credentials, Input::get('remember'));

            return Redirect::to('admin');

        } catch( Exception $e ){
            $exception = get_class($e);
            $msg = (Lang::has("sentry.{$exception}")) ? Lang::get("sentry.{$exception}") : $e->getMessage();

            Session::flash('error', $msg);
        }


        return Redirect::to('admin/login');
    }

    public function getLogout()
    {
        Sentry::logout();
        Session::flash('success', 'Logout successful');

        return Redirect::to('admin/login');
    }
}
