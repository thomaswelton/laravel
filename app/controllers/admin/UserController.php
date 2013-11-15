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


class UserController extends BaseController
{
    protected $user = null;

    public function __construct(\User $user){
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $query = $this->user->with('facebook');

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
        return View::make('admin.user.form', array(
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
        // Get validation rules
        $rules = $this->user->$rules;
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
        try {
            $user = Sentry::getUserProvider()->findById($id);

            $data = Input::all();

            // Update the user
            if ($user->update($data)) {
                Session::flash('success', 'User updated');
            } else {
                Session::flash('error', 'User could not be saved.');
                return Redirect::action('Admin\\UserController@edit', $id)->withErrors($user->errors());
            }
        } catch (UserNotFoundException $e) {
            Session::flash('error', 'No user found');
        }

        return Redirect::action('Admin\\UserController@index');
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

            $this->user->destroy($id);
        } catch (Exception $e) {
            Session::flash('error', $e->getMessage());

            return Redirect::to('admin/users');
        }

        $msg = View::make('admin.partials.flash_item_deleted', array(
            'restore' => URL::action('Admin\\UserController@postRestore', $id),
            'msg' => 'User deleted.',
        ))->__toString();

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
        $user = $this->user->find($id);

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
        $this->user->withTrashed()->where('id', $id)->restore();

        Session::flash('success', 'User restored');

        return Redirect::to('admin/users');
    }

}
