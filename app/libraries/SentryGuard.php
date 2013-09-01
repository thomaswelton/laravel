<?php

use Illuminate\Auth\Guard;
use Illuminate\Auth\UserInterface;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\WrongPasswordException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Cartalyst\Sentry\Users\UserNotActivatedException;

class SentryGuard extends Guard {

    public function login(UserInterface $user, $remember = false)
    {
        try
        {
            // Find the user using the user id
            $user = Sentry::getUserProvider()->findById($user->getAuthIdentifier());

            // Log the user in
            Sentry::login($user, $remember);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
        }

        return false;
    }

    /**
     * Log the given user ID into the application.
     *
     * @param  mixed  $id
     * @param  bool   $remember
     * @return \Illuminate\Auth\UserInterface
     */
    public function loginUsingId($id, $remember = false)
    {
        try
        {
            // Find the user using the user id
            $user = Sentry::getUserProvider()->findById($id);

            // Log the user in
            Sentry::login($user, $remember);
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
        }

        return false;
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout()
    {
        Sentry::logout();
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        return Sentry::check();
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Auth\UserInterface|null
     */
    public function user()
    {
        return Sentry::getUser();
    }
}
