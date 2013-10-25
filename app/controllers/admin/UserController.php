<?php namespace Admin;

use Illuminate\Support\Facades\Validator;
use \Redirect;
use \Response;
use \Request;
use \View;
use \Input;
use \Session;
use \Exception;
use \URL;
use \Mail;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Cartalyst\Sentry\Users\UserNotFoundException;

use \User;

/***************
 View Composers
****************/

View::composer('admin.user.form', function($view)
{
    $view->with('groups', Sentry::findAllGroups());
});

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $query = User::with('facebook');

        $users = new UserListView($query);

        switch (Request::query('format')) {
            case 'csv':
                return Response::download($users->getCsvFile(), 'user.csv');
                break;

            default:
                return View::make('admin.user.index', array(
                    'users' => $users
                ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Get validation rules
        $rules = User::$rules;

        return View::make('admin.user.form', array(
            'header' => 'Create User',
            'rules' => $rules
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Get validation rules
        $rules = User::$rules;
        // Set password confirmation rule
        $rules['password'] .= '|confirmed';


        $validator = Validator::make(Input::all(), $rules);

        if (!$validator->fails()){
            try {
                $user = Sentry::createUser(array(
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                ));
                // Activate user
                $user->attemptActivation($user->getActivationCode());

                if(Input::has('superuser')){
                    $user->superuser = Input::get('superuser');
                }

                $user->groups = Input::get('groups');

                if(Input::get('notify')){
                    // Send notifcation email
                    $loginLink = ($user->hasAccess('admin')) ? URL::to('admin/login') : URL::to('login');
                    $mailData = array('user' => $user, 'password' => Input::get('password'), 'loginLink' => $loginLink);

                    Mail::queue(array('emails.admin.newuser', 'emails.admin.newuser_text'), $mailData, function($message) use ($user)
                    {
                        $message->to($user->email, $user->first_name . ' ' . $user->last_name)->subject('Huurd.it - User account created');
                    });
                }

                Session::flash('success', 'User added');

                return Redirect::to('admin/users');
            } catch (Exception $e) {
                Session::flash('error', $e->getMessage());
            }
        }

        Input::flash();
        return Redirect::to('admin/users/create')->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param  int      $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = Sentry::getUserProvider()->findById($id);
            print_r($user);
            die;
        } catch (UserNotFoundException $e) {
            Session::flash('User not found', $e->getMessage());

            return Redirect::to('admin/users');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int      $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            // Get user
            $user = Sentry::getUserProvider()->findById($id);

            return View::make('admin.user.form', array(
                'header' => 'Edit User',
                'user' => $user,
                'oauthProviders' => array('facebook', 'twitter', 'instagram', 'google', 'github'),
            ));
        } catch (UserNotFoundException $e) {
            Session::flash('error', 'No user found');

            return Redirect::to('admin/users');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function update($id)
    {
        $rules = User::$rules;

        // Password not required if not set
        if(!Input::has('password')){
            unset($rules['password']);
        }

        $validator = Validator::make(Input::all(), $rules);

        if (!$validator->fails()){
            try {
                // Find the user using the user id
                $user = Sentry::getUserProvider()->findById($id);

                // Update the user details
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->email = Input::get('email');
                $user->groups = Input::get('groups');

                //If password is set update the password
                if(Input::has('password')){
                    $user->password = Input::get('password');
                }

                if(Input::has('superuser')){
                    $user->superuser = Input::get('superuser');
                }

                // Update the user
                if ($user->save()) {
                    Session::flash('success', 'User updated');

                    return Redirect::to('admin/users');
                } else {
                   Session::flash('error', 'User could not be saved.');
                }
            } catch (Exception $e) {
                Session::flash('error', $e->getMessage());
            }
        }

        Input::flash();
        return Redirect::to('admin/users/'.$id.'/edit')->withErrors($validator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int      $id
     * @return Response
     */
    public function destroy($id)
    {
        // TODO: cant delete the last superadmin only super admins can delete
        try {
            $user = Sentry::getUserProvider()->findById($id);

            // Only super users and can delete other super users
            if($user->isSuperUser() && !Sentry::getUser()->isSuperUser()){
                throw new Exception('You are not authorized to delete this user.');
            }

            User::destroy($id);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());

            return Redirect::to('admin/users');
        }

        $msg = (string) View::make('admin.partials.flash_user_deleted', array('id' => $id));
        Session::flash('success', $msg);

        return Redirect::to('admin/users');
    }

    /**
     * Delete an oath link
     *
     * @param  int      $id
     * @return Redirect
     */
    public function deleteOauth($id)
    {
        $provider = Input::get('provider');
        $user = User::find($id);

        $user->$provider()->delete();

        Session::flash('success', 'Account link deleted');

        return Redirect::to('admin/users/' . $id . '/edit');
    }

    /**
     * Restore the specified resource from trash.
     *
     * @param  int      $id
     * @return Redirect
     */
    public function postRestore($id)
    {
        User::withTrashed()->where('id', $id)->restore();

        Session::flash('success', 'User restored');

        return Redirect::to('admin/users');
    }

}
