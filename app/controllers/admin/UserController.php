<?php namespace Admin;

use \Redirect;
use \Response;
use \Request;
use \View;
use \Input;
use \Session;
use \Exception;

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
        switch (Request::query('format')) {
            case 'csv':
                return Response::csv(User::all(), 'user.csv');
                break;

            case 'json':
                return Response::json(User::all());
                break;

            default:
                $this->layout->content = View::make('admin.user.index', array(
                    'users' => User::with('facebook')->paginate(10)
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
        $this->layout->content = View::make('admin.user.form', array(
            'header' => 'Create User'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            $user = Sentry::register(array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            ), true);

            Session::flash('success', 'User added');

            return Redirect::to('admin/users');
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        Input::flash();

        return Redirect::to('admin/users/create');
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

            $this->layout->content = View::make('admin.user.form', array(
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
        try {
            // Find the user using the user id
            $user = Sentry::getUserProvider()->findById($id);

            // Update the user details
            $user->email = Input::get('email');

            //If password is set update the password
            if(Input::has('password')){
                $user->password = Input::get('password');
            }

            if(Input::has('superuser')){
                $user->superuser = Input::get('superuser');
            }

            $user->groups = Input::get('groups');

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

        Input::flash();

        return Redirect::to('admin/users/'.$id.'/edit');
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
