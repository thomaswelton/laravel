<?php

use Cartalyst\Sentry\Facades\Laravel\Sentry;

class PasswordController extends BaseController
{
    public $layout = 'layouts.bootstrap';

    public function getIndex()
    {
        $this->layout->content = View::make('password.index');
    }

    public function postIndex()
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
            return Redirect::action('PasswordController@getReset');
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            Session::flash('error', 'Email address not found.');
            Input::flash();
        }

        return Redirect::action('PasswordController@getIndex');
    }

    public function getReset()
    {
        $this->layout->content = View::make('password.reset');
    }

    public function getDone()
    {
        $this->layout->content = View::make('password.done');
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
                        return Redirect::action('PasswordController@getDone');
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
        return Redirect::action('PasswordController@getReset')->withErrors($validator);
    }
}
