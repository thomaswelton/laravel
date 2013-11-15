<?php

use Cartalyst\Sentry\Facades\Laravel\Sentry;

class AuthController extends BaseController
{
    public function getLogin()
    {
        if (Sentry::check()) {
            return Redirect::to('/');
        }

        return View::make('auth.login');
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
            Sentry::authenticate($credentials, Input::get('remember'));

            return Redirect::to('/');

        } catch( Exception $e ){
            $exception = get_class($e);
            $msg = (Lang::has("sentry.{$exception}")) ? Lang::get("sentry.{$exception}") : $e->getMessage();

            Session::flash('error', $msg);
        }

        return Redirect::to('/login');
    }

    public function getForgot()
    {
        return View::make('auth.forgot');
    }

    public function postForgot()
    {
        $this->beforeFilter('csrf');
        $email = Input::get('email');

        try
        {
            $user = Sentry::findUserByCredentials(array(
                'email'      => $email
            ));

            $code = $user->getResetPasswordCode();

            Mail::queue(array('emails.password.reset', 'emails.password.reset_text'), array('code' => $code), function($message) use ($user)
            {
                $message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Password Reset');
            });

            Session::flash('success', 'An email has been sent with your password reset code');
            return Redirect::action('AuthController@getReset');
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            Session::flash('error', 'Email address not found.');
            Input::flash();
        }

        return Redirect::action('AuthController@getForgot');
    }

    public function getReset()
    {
        return View::make('auth.reset');
    }

    public function getDone()
    {
        return View::make('auth.done');
    }

    public function postReset()
    {
        $this->beforeFilter('csrf');

        // Use the same password validation rules
        // from the user model
        $rules = array(
            'code' => 'required',
            'email' => 'required|email',
            'password' => User::$rules['password'] . '|confirmed'
        );

        $validator = Validator::make(Input::all(), $rules);

        if (!$validator->fails()){
            try
            {
                $user = Sentry::findUserByCredentials(array(
                    'email' => Input::get('email')
                ));

                if ($user->checkResetPasswordCode(Input::get('code'))){
                    if ($user->attemptResetPassword(Input::get('code'), Input::get('password'))){
                        // Password reset passed
                        Mail::queue(array('emails.password.done','emails.password.done_text'), array(), function($message) use ($user)
                        {
                            $message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Password Reset Successful');
                        });
                        return Redirect::action('AuthController@getDone');
                    }
                    else{
                        // Password reset failed
                        Session::flash('error', 'Your password could not be reset');
                    }
                }else{
                    // The provided password reset code is Invalid
                    Session::flash('error', 'Invalid password reset code');
                }
            }
            catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                Session::flash('error', 'User not found, please check your email address');
            }
        }else{
            Session::flash('error','Please correct the following errors and try again');
        }

        Input::flash();
        return Redirect::action('AuthController@getReset')->withErrors($validator);
    }
}
